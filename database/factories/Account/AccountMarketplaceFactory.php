<?php

namespace Database\Factories\Account;

use App\Enums\MarketplaceID;
use App\Models\Account\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account\AccountMarketplace>
 */
class AccountMarketplaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'account_id' => function () {
                return Account::factory()->create()->id;
            },
            'marketplace_id' => MarketplaceID::getRandomValue()
        ];
    }
}
