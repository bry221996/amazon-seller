<?php

namespace Tests\Feature\V1\API\Account\Advertising\PortfolioController;

use App\Models\Account\Account;
use App\Models\Account\Advertising\Portfolio;
use App\Models\Account\Advertising\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function list_advertising_portfolios()
    {
        $account = Account::factory()->create();

        $profile = Profile::factory()->has(Portfolio::factory()->count(10))
            ->create(['account_id' => $account->id]);

        $this->getJson("/api/v1/accounts/$account->id/advertising/profiles/$profile->id/portfolios")
            ->dump();
    }

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function list_advertising_portfolios_with_marketplace()
    {
        $account = Account::factory()->create();

        Profile::factory()
            ->create(['account_id' => $account->id]);

        $this->getJson("/api/v1/accounts/$account->id/advertising/profiles?include[]=marketplace")
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'account_id',
                        'marketplace_id',
                        'daily_budget',
                        'marketplace' => [
                            'id',
                            'name',
                            'region_id',
                            'country',
                            'timezone',
                            'domain_name',
                            'country_code',
                            'currency_code',
                            'language_code'
                        ]
                    ]
                ]
            ]);
    }
}
