<?php

namespace Tests\Feature\V1\API\Account\Advertising\AdGroupController;

use App\Enums\MarketplaceID;
use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use App\Models\Account\Advertising\AdGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $account;

    protected $marketplace_id;

    protected $profile_id;

    public function setUp(): void
    {
        parent::setUp();

        $this->account = Account::factory()->create();

        $this->marketplace_id = MarketplaceID::getRandomValue();

        $this->profile_id = AccountMarketplace::factory()
            ->withProfileId()
            ->create([
                'account_id' => $this->account->id,
                'marketplace_id' => $this->marketplace_id
            ])
            ->profile_id;
    }

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function list_ad_groups()
    {
        AdGroup::factory()->count($count = $this->faker()->numberBetween(1, 10))
            ->create(['profile_id' => $this->profile_id]);

        $this->getJson('/api/v1/account/advertising/ad-groups', [
            'X-Account-ID' => $this->account->id,
            'X-Marketplace-ID' => $this->marketplace_id
        ])
            ->assertOk()
            ->assertJsonCount($count, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'id', 'campaign_id', 'name', 'default_bid', 'state', 'created_at', 'updated_at'
                    ]
                ]
            ]);
    }

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function list_ad_groups_with_campaign()
    {
        AdGroup::factory()->count($count = $this->faker()->numberBetween(1, 10))
            ->create(['profile_id' => $this->profile_id]);

        $this->getJson('/api/v1/account/advertising/ad-groups?include[]=campaign', [
            'X-Account-ID' => $this->account->id,
            'X-Marketplace-ID' => $this->marketplace_id
        ])
            ->assertOk()
            ->assertJsonCount($count, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'id', 'campaign_id', 'name', 'default_bid', 'state', 'created_at', 'updated_at', 'campaign'
                    ]
                ]
            ]);
    }

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function list_ad_groups_filtered_by_states()
    {
        $values  = ['enabled', 'paused', 'archived'];
        $account = Account::factory()->create();
        $marketplaceId = MarketplaceID::getRandomValue();

        $account_marketplace = AccountMarketplace::factory()
            ->withProfileId()
            ->create([
                'account_id' => $account->id,
                'marketplace_id' => $marketplaceId
            ]);

        $filteredAdGroups = AdGroup::factory()
            ->count($count = $this->faker()->numberBetween(1, 3))
            ->create([
                'profile_id' => $account_marketplace->profile_id,
                'state' => $value = $this->faker()->randomElement($values)
            ]);

        $unfilteredAdGroups = AdGroup::factory()
            ->count($this->faker()->numberBetween(1, 3))
            ->create([
                'profile_id' => $account_marketplace->profile_id,
                'state' => $this->faker()->randomElement(
                    collect($values)->filter(fn ($i) => $i !== $value)->toArray()
                )
            ]);

        $this->getJson("/api/v1/account/advertising/ad-groups?filter[states][]=$value", [
            'X-Account-ID' => $account->id,
            'X-Marketplace-ID' => $marketplaceId
        ])
            ->assertJsonCount($count, 'data')
            ->assertSuccessful()
            ->assertJsonFragment([
                'id' => $filteredAdGroups->random()->id,
                'state' => $value
            ])
            ->assertJsonMissing([
                'id' => $unfilteredAdGroups->random()->id
            ]);
    }
}
