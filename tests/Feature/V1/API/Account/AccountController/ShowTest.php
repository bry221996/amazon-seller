<?php

namespace Tests\Feature\V1\API\Account\AccountController;

use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function show_account_details()
    {
        $account = Account::factory()->create();

        AccountMarketplace::factory()->create(['account_id' => $account->id]);

        $this->getJson("/api/v1/account", ['X-Account-ID' => $account->id])
            ->assertJsonFragment([
                'id' => $account->id,
                'name' => $account->name
            ])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                    'marketplaces' => [
                        [
                            'id',
                            'name',
                            'region_id',
                            'country',
                            'timezone',
                            'domain_name',
                            'country_code',
                            'language_code',
                            'profile_id'
                        ]
                    ]
                ]
            ]);
    }
}
