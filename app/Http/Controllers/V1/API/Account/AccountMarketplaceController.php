<?php

namespace App\Http\Controllers\V1\API\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\Http\Resources\MarketplaceResource;
use App\Integrations\Amazon\Advertising;
use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use App\Models\Account\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AccountMarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $account_id = $request->account->id;

        $credential = Credential::where('service', 'advApi')
            ->where('account_id', $account_id)
            ->first();

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

            $account_marketplaces = collect($profiles)
                ->filter(fn ($profile) => $profile->accountInfo->id === $account_id && $profile->accountInfo->type === 'seller')
                ->map(function ($profile) use ($account_id) {
                    return [
                        'profile_id' => $profile->profileId,
                        'account_id' => $account_id,
                        'marketplace_id' => $profile->accountInfo->marketplaceStringId
                    ];
                })->toArray();

            AccountMarketplace::upsert($account_marketplaces, ['account_id', 'marketplace_id'], ['profile_id']);
        }

        $request->account->load('marketplaces');

        return MarketplaceResource::collection($request->account->marketplaces);
    }
}
