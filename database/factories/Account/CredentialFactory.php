<?php

namespace Database\Factories\Account;

use App\Models\Account\Account;
use App\Models\Account\Credential;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountCredential>
 */
class CredentialFactory extends Factory
{
    protected $model = Credential::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'account_id' => function () {
                return Account::factory()->id;
            },
            'service' => $this->faker->randomElement(['spApi', 'advApi']),
            'access_token' => Str::random(48),
            'refresh_token' => Str::random(48),
            'access_token_expiration' => $this->faker->dateTime(),
            'oauth_code' => $this->faker->lexify('????????')
        ];
    }
}
