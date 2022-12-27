<?php

namespace Database\Factories\Account\Advertising;

use App\Models\Account\Advertising\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account\Advertising\Portfolio>
 */
class PortfolioFactory extends Factory
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
                return Profile::factory()->create()->id;
            },
            'name' => $this->faker->words(4, true),
            'in_budget' => $this->faker->boolean(),
            'budget' => json_encode((object) [
                'amount' => $this->faker->numberBetween(1, 100),
                'currencyCode' => $this->faker->currencyCode,
                'policy' => 'monthlyRecurring'
            ]),
            'state' => $this->faker->randomElement(['enabled', 'paused', 'archived']),
            'serving_status' => $this->faker->randomElement([
                'PORTFOLIO_STATUS_ENABLED',
                'PORTFOLIO_PAUSED',
                'PORTFOLIO_ARCHIVED',
                'PORTFOLIO_OUT_OF_BUDGET',
                'PENDING_START_DATE',
                'ENDED'
            ]),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }

    /**
     * Indicate that the portfolio is enabled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function enabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'state' => 'enabled',
                'serving_status' => 'PORTFOLIO_STATUS_ENABLED'
            ];
        });
    }

    /**
     * Indicate that the portfolio is paused.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function paused()
    {
        return $this->state(function (array $attributes) {
            return [
                'state' => 'paused',
                'serving_status' => 'PORTFOLIO_PAUSED'
            ];
        });
    }

    /**
     * Indicate that the portfolio is archived.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function archived()
    {
        return $this->state(function (array $attributes) {
            return [
                'state' => 'archived',
                'serving_status' => 'PORTFOLIO_ARCHIVED'
            ];
        });
    }
}
