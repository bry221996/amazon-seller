<?php

namespace Database\Seeders;

use App\Models\Account\Account;
use App\Models\Account\Credential;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = Account::factory()->create(['id' =>  env('TEST_ACCOUNT_ID')]);

        Credential::factory()->create([
            'account_id' => $account->id,
            'service' => 'spApi',
            'access_token' => env('TEST_ACCOUNT_SP_API_ACCESS_TOKEN'),
            'refresh_token' => env('TEST_ACCOUNT_SP_API_REFRESH_TOKEN'),
        ]);

        Credential::factory()->create([
            'account_id' => $account->id,
            'service' => 'advApi',
            'access_token' => env('TEST_ACCOUNT_ADV_API_ACCESS_TOKEN'),
            'refresh_token' => env('TEST_ACCOUNT_ADV_API_REFRESH_TOKEN'),
        ]);
    }
}
