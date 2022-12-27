<?php

namespace Tests\Feature\V1\API\Account\AccountMarketplaceController;

use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function get_account_marketplaces()
    {
        $account = Account::factory()->create();

        AccountMarketplace::factory()
            ->count($count = $this->faker()->numberBetween(1, 3))
            ->create(['account_id' => $account->id]);

        $this->getJson('/api/v1/account/marketplaces', ['X-Account-ID' => $account->id])
            ->assertJsonCount($count, 'data')
            ->assertJsonStructure([
                'data' => [
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
            ]);
    }
}
