<?php

namespace Database\Factories\Account\Advertising;

use App\Enums\MarketplaceID;
use App\Models\Account\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account\Advertising\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomNumber(9),
            'account_id' => function () {
                return Account::factory()->create()->id;
            },
            'marketplace_id' => MarketplaceID::getRandomValue(),
            'daily_budget' => $this->faker->randomNumber()
        ];
    }
}
