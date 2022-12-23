<?php

namespace Tests\Feature\V1\API\Account\Advertising\ProfileController;

use App\Models\Account\Account;
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
    public function list_advertising_profiles()
    {
        $account = Account::factory()->create();

        Profile::factory()
            ->count($count = $this->faker->numberBetween(1, 5))
            ->create(['account_id' => $account->id]);

        $this->getJson("/api/v1/accounts/$account->id/advertising/profiles")
            ->assertOk()
            ->assertJsonCount($count, 'data')
            ->assertJsonFragment(['account_id' => $account->id])
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'account_id',
                        'marketplace_id',
                        'daily_budget'
                    ]
                ]
            ]);
    }

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function list_advertising_profiles_with_marketplace()
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
