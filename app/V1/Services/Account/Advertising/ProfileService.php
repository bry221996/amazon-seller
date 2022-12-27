<?php

namespace App\V1\Services\Account\Advertising;


use App\Models\Account\Credential;
use App\Models\Account\Advertising\Profile;
use App\Integrations\Amazon\Advertising;
use Illuminate\Support\Facades\Cache;

class ProfileService
{
    /**
     * Get all profiles by account_id
     *
     * @param string $account_id
     * @param array $options
     * @return array Profile
     */
    public function getAllByAccountId(string $account_id, array $options = [])
    {
        $this->syncByAccountId($account_id);

        return Profile::where('account_id', $account_id)
            ->with(isset($options['include']) ? $options['include'] : [])
            ->get();
    }

    /**
     * Sync Accounts By ProfileId
     *
     * @param string $account_id
     * @return void
     */
    public function syncByAccountId(string $account_id)
    {
        $credential = Credential::where('account_id', $account_id)
            ->where('service', 'advApi')
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

            Profile::upsert($formattedProfiles,  ['id'],  ['account_id', 'daily_budget']);
        }
    }
}
