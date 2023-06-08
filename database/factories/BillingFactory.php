<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Billing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Billing>
 */

class BillingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->unique()->numberBetween(1, 20),
            'amount' => $this->faker->randomNumber(5, true),
            'description' => $this->faker->text(),
            'due_date' => $this->faker->date()
        ];
    }
}
