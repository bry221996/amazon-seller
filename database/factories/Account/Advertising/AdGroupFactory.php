<?php

namespace Database\Factories\Account\Advertising;

use App\Models\Account\AccountMarketplace;
use App\Models\Account\Advertising\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account\Advertising\AdGroup>
 */
class AdGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' =>  $this->faker->randomNumber(9),
            'profile_id' => function () {
                return AccountMarketplace::factory()
                    ->withProfileId()
                    ->create()
                    ->profile_id;
            },
            'campaign_id' => function () {
                return Campaign::factory()->create()->id;
            },
            'name' =>  $this->faker->words(4, true),
            'default_bid' => $this->faker->numberBetween(1, 10),
            'state' => $this->faker->randomElement(['enabled', 'paused', 'archived']),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
