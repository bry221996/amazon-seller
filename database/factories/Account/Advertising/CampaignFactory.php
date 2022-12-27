<?php

namespace Database\Factories\Account\Advertising;

use App\Enums\Account\Advertising\CampaignType;
use App\Models\Account\AccountMarketplace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account\Advertising\Campaign>
 */
class CampaignFactory extends Factory
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
                return AccountMarketplace::factory()->create()->profile_id;
            },
            'portfolio_id' => null,
            'name' =>  $this->faker->words(4, true),
            'budget' => $this->faker->numberBetween(1, 100),
            'budget_type' => 'daily',
            'campaign_type' => CampaignType::getRandomValue(),
            'state' => $this->faker->randomElement(['enabled', 'paused', 'archived']),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
