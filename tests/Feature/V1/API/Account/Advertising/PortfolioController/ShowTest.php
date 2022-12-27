<?php

namespace Tests\Feature\V1\API\Account\Advertising\PortfolioController;

use App\Enums\MarketplaceID;
use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use App\Models\Account\Advertising\Portfolio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function show_advertising_portfolios()
    {
        $account = Account::factory()->create();

        $marketplaceId = MarketplaceID::getRandomValue();

        $account_marketplace = AccountMarketplace::factory()
            ->withProfileId()
            ->create([
                'account_id' => $account->id,
                'marketplace_id' => $marketplaceId
            ]);

        $portfolio = Portfolio::factory()->create(['profile_id' => $account_marketplace->profile_id]);

        $this->getJson("/api/v1/account/advertising/portfolios/$portfolio->id", [
            'X-Account-ID' => $account->id,
            'X-Marketplace-ID' => $marketplaceId
        ])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'profile_id',
                    'name',
                    'budget' => [
                        'amount',
                        'policy',
                        'currencyCode'
                    ],
                    'in_budget',
                    'state',
                    'serving_status',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function show_not_existing_advertising_portfolios()
    {
        $account = Account::factory()->create();

        $marketplaceId = MarketplaceID::getRandomValue();

        $account_marketplace = AccountMarketplace::factory()
            ->withProfileId()
            ->create([
                'account_id' => $account->id,
                'marketplace_id' => $marketplaceId
            ]);

        $portfolioId = $this->faker()->randomNumber(9);

        $this->getJson("/api/v1/account/advertising/portfolios/$portfolioId", [
            'X-Account-ID' => $account->id,
            'X-Marketplace-ID' => $marketplaceId
        ])
            ->assertStatus(404);
    }
}
