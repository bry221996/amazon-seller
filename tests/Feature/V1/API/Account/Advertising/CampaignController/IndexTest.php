<?php

namespace Tests\Feature\V1\API\Account\Advertising\CampaignController;

use App\Enums\Account\Advertising\CampaignType;
use App\Enums\Account\Advertising\TargetingType;
use App\Enums\MarketplaceID;
use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use App\Models\Account\Advertising\Campaign;
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
    public function list_campaigns()
    {
        $account = Account::factory()->create();

        $marketplaceId = MarketplaceID::getRandomValue();

        $account_marketplace = AccountMarketplace::factory()
            ->withProfileId()
            ->create([
                'account_id' => $account->id,
                'marketplace_id' => $marketplaceId
            ]);

        Campaign::factory()->count($count = $this->faker()->numberBetween(1, 10))
            ->create(['profile_id' => $account_marketplace->profile_id]);

        $this->getJson('/api/v1/account/advertising/campaigns', [
            'X-Account-ID' => $account->id,
            'X-Marketplace-ID' => $marketplaceId
        ])
            ->assertSuccessful()
            ->assertJsonCount($count, 'data');
    }

    /**
     * @test
     * @group account
     * @group advertising
     * @dataProvider multipleFiltersDataProvider
     */
    public function list_campaigns_filtered_by_multilple_values($attribute, $filter_key, $values)
    {
        $account = Account::factory()->create();
        $marketplaceId = MarketplaceID::getRandomValue();

        $account_marketplace = AccountMarketplace::factory()
            ->withProfileId()
            ->create([
                'account_id' => $account->id,
                'marketplace_id' => $marketplaceId
            ]);

        $filteredCampaigns = Campaign::factory()
            ->count($count = $this->faker()->numberBetween(1, 3))
            ->create([
                'profile_id' => $account_marketplace->profile_id,
                $attribute => $value = $this->faker()->randomElement($values)
            ]);

        $unfilteredCampaigns = Campaign::factory()
            ->count($this->faker()->numberBetween(1, 3))
            ->create([
                'profile_id' => $account_marketplace->profile_id,
                $attribute => $this->faker()->randomElement(
                    collect($values)->filter(fn ($i) => $i !== $value)->toArray()
                )
            ]);

        $this->getJson("/api/v1/account/advertising/campaigns?filter[$filter_key][]=$value", [
            'X-Account-ID' => $account->id,
            'X-Marketplace-ID' => $marketplaceId
        ])
            ->assertJsonCount($count, 'data')
            ->assertSuccessful()
            ->assertJsonFragment([
                'id' => $filteredCampaigns->random()->id,
                $attribute => $value
            ])
            ->assertJsonMissing([
                'id' => $unfilteredCampaigns->random()->id
            ]);
    }

    public function multipleFiltersDataProvider()
    {
        return [
            [
                'attribute' => 'campaign_type',
                'filter_key' => 'campaign_types',
                'values' => CampaignType::getValues()
            ],
            [
                'attribute' => 'targeting_type',
                'filter_key' => 'targeting_types',
                'values' => TargetingType::getValues()
            ],
            [
                'attribute' => 'portfolio_id',
                'filter_key' => 'portfolio_ids',
                'values' => [1, 2, 3, 4, 5]
            ],
        ];
    }
}
