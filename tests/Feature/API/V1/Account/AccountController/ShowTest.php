<?php

namespace Tests\Feature\API\V1\Account\AccountController;

use App\Models\Account\Account;
use App\Models\Account\AccountMarketplace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function show_account_details()
    {
        $account = Account::factory()->create();

        AccountMarketplace::factory()->create(['account_id' => $account->id]);

        $this->getJson("/api/v1/accounts/$account->id")
            ->assertJsonFragment([
                'id' => $account->id,
                'name' => $account->name
            ])
            ->dump();
    }
}
