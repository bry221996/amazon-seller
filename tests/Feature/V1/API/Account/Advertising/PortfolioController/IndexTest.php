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

    /**
     * @test
     * @group account
     * @group advertising
     */
    public function list_advertising_portfolios_filtered_by_state()
    {
        $account = Account::factory()->create();

        $states = ['enabled', 'paused', 'archived'];
        $state = $this->faker()->randomElement($states);

        $profile = Profile::factory()
            ->has(Portfolio::factory()->enabled()->count($this->faker()->numberBetween(1, 3)))
            ->has(Portfolio::factory()->paused()->count($this->faker()->numberBetween(1, 3)))
            ->has(Portfolio::factory()->archived()->count($this->faker()->numberBetween(1, 3)))
            ->create(['account_id' => $account->id]);

        $this->getJson("/api/v1/accounts/$account->id/advertising/profiles/$profile->id/portfolios?filter[state]=$state")
            ->assertJsonFragment(['state' => $state])
            ->assertJsonMissing(['state' => $this->faker()->randomElement(collect($states)->filter(fn ($i) => $i !== $state)->toArray())]);
    }
}
