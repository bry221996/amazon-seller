<?php

namespace App\V1\Services\Account\Advertising;

use App\Integrations\Amazon\Advertising;
use App\V1\Repositories\Account\Advertising\ProfileRepository;
use App\V1\Repositories\Account\CredentialRepository;
use Illuminate\Support\Facades\Cache;

class ProfileService
{
    protected $profileRepository;
    protected $credentialRepository;

    public function __construct(ProfileRepository $profileRepository, CredentialRepository $credentialRepository)
    {
        $this->profileRepository = $profileRepository;

        $this->credentialRepository = $credentialRepository;
    }

    /**
     * Get all profiles by account_id
     *
     * @param string $account_id
     * @param array $options
     * @return void
     */
    public function getAllByAccountId(string $account_id, array $options = [])
    {
        $this->syncByAccountId($account_id);

        return $this->profileRepository->getAllByAccountId($account_id, $options);
    }

    public function syncByAccountId(string $account_id)
    {
        $credential = $this->credentialRepository->getByAccountIdAndService($account_id, 'advApi');

        if ($credential) {
            $profiles = Cache::remember("$account_id:profiles", 3600, function () use ($credential) {
                $client = new Advertising([
                    'id' => $credential->account_id,
                    'refresh_token' => $credential->refresh_token,
                    'access_token' => $credential->access_token,
                    'region' => 'na'
                ]);

                return $client->listProfiles();
            });

            $formattedProfiles = collect($profiles)
                ->filter(fn ($profile) => $profile->accountInfo->id === $account_id && $profile->accountInfo->type === 'seller')
                ->map(function ($profile) use ($account_id) {
                    return [
                        'id' => $profile->profileId,
                        'account_id' => $account_id,
                        'marketplace_id' => $profile->accountInfo->marketplaceStringId,
                        'daily_budget' => $profile->dailyBudget
                    ];
                })->toArray();

            $this->profileRepository->upsert($formattedProfiles,  ['id'],  ['account_id', 'daily_budget']);
        }
    }
}
