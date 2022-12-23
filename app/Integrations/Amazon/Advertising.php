<?php

namespace App\Integrations\Amazon;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Advertising
{
    protected $id;

    protected $access_token;

    protected $refresh_token;

    protected $client_id;

    protected $client_secret;

    protected $base_uri;

    public function __construct(array $options)
    {
        $this->id = $options['id'];

        $this->access_token = $options['access_token'];

        $this->refresh_token = $options['refresh_token'];

        $this->region = $options['region'];

        $this->base_uri = config("integrations.amazon.advertising.endpoints.$this->region");

        $this->client_id = config('integrations.amazon.advertising.client_id');

        $this->client_secret = config('integrations.amazon.advertising.client_secret');
    }


    public function getAccessToken(): string
    {
        return Cache::remember("$this->id:amazon:advertising:access_token", 3600, function () {
            $data = [
                'grant_type' => 'refresh_token',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'refresh_token' => $this->refresh_token
            ];

            return Http::post('https://api.amazon.com/auth/o2/token', $data)
                ->throw()
                ->json('access_token');
        });
    }


    public function listProfiles()
    {
        return $this->sendRequest('GET', 'v2/profiles');
    }

    public function sendRequest($method, $uri, $payload = [])
    {
        $headers = [
            'Amazon-Advertising-API-ClientId' => $this->client_id
        ];

        $response = Http::withHeaders($headers)
            ->withToken($this->getAccessToken())
            ->retry(2, 0, function ($exception, $request) {
                if (!$exception instanceof RequestException || $exception->response->status() !== 401) {
                    return false;
                }

                $request->withToken($this->getAccessToken());

                return true;
            })
            ->$method("$this->base_uri/$uri", $payload)
            ->throw()
            ->object();

        return $response;
    }
}
