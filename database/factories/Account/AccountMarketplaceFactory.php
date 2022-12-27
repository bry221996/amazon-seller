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
            'marketplace_id' => MarketplaceID::getRandomValue(),
            'profile_id' => null
        ];
    }

    /**
     * Indicate that the account marketplace has profile id
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withProfileId()
    {
        return $this->state(function (array $attributes) {
            return [
                'profile_id' => $this->faker->randomNumber(9),
            ];
        });
    }
}
