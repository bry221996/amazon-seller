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

        $profile = Profile::factory()
            ->has(
                Portfolio::factory()->count($count = $this->faker()->numberBetween(1, 10))
            )
            ->create(['account_id' => $account->id]);

        $this->getJson("/api/v1/accounts/$account->id/advertising/profiles/$profile->id/portfolios")
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
}
