<?php

namespace Tests\Feature\V1\API\Account\Advertising\PortfolioController;

use App\Enums\MarketplaceID;
use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use App\Models\Account\Advertising\Portfolio;
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

        $marketplaceId = MarketplaceID::getRandomValue();

        $account_marketplace = AccountMarketplace::factory()
            ->withProfileId()
            ->create([
                'account_id' => $account->id,
                'marketplace_id' => $marketplaceId
            ]);

        Portfolio::factory()->count($count = $this->faker()->numberBetween(1, 10))
            ->create(['profile_id' => $account_marketplace->profile_id]);

        $this->getJson('/api/v1/account/advertising/portfolios', [
            'X-Account-ID' => $account->id,
            'X-Marketplace-ID' => $marketplaceId
        ])
            ->assertJsonCount($count, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
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
                ]
            ]);
    }

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function list_advertising_portfolios_filtered_by_state()
    {
        $account = Account::factory()->create();

        $marketplaceId = MarketplaceID::getRandomValue();

        $account_marketplace = AccountMarketplace::factory()
            ->withProfileId()
            ->create([
                'account_id' => $account->id,
                'marketplace_id' => $marketplaceId
            ]);

        $states = ['enabled', 'paused', 'archived'];
        $state = $this->faker()->randomElement($states);

        Portfolio::factory()
            ->enabled()
            ->count($this->faker()->numberBetween(1, 3))
            ->create(['profile_id' => $account_marketplace->profile_id]);

        Portfolio::factory()
            ->paused()
            ->count($this->faker()->numberBetween(1, 3))
            ->create(['profile_id' => $account_marketplace->profile_id]);

        Portfolio::factory()
            ->archived()
            ->count($this->faker()->numberBetween(1, 3))
            ->create(['profile_id' => $account_marketplace->profile_id]);

        $this->getJson("/api/v1/account/advertising/portfolios?filter[state]=$state", [
            'X-Account-ID' => $account->id,
            'X-Marketplace-ID' => $marketplaceId
        ])
            ->assertJsonFragment(['state' => $state])
            ->assertJsonMissing(['state' => $this->faker()->randomElement(collect($states)->filter(fn ($i) => $i !== $state)->toArray())]);
    }
}
