<?php

namespace Tests\Feature\V1\API\Account\Advertising\CampaignController;

use App\Enums\MarketplaceID;
use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use App\Models\Account\Advertising\Campaign;
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
    public function show_campaign_details()
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

        $campaign = Campaign::factory()
            ->create([
                'profile_id' => $account_marketplace->profile_id,
                'portfolio_id' => $portfolio->id
            ]);

        $this->getJson("/api/v1/account/advertising/campaigns/$campaign->id", [
            'X-Account-ID' => $account->id,
            'X-Marketplace-ID' => $marketplaceId
        ])
            ->assertSuccessful();
    }
}
