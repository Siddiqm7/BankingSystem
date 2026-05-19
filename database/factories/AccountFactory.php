<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->value('id'),
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(18, 60),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'account_type' => $this->faker->randomElement(['savings', 'current']),
            'account_opening_date' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'account_status' => $this->faker->randomElement(['active', 'inactive']),
            'account_number' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'current_account_balance' => $this->faker->randomFloat(2, 1000, 50000),
            'savings_account_balance' => $this->faker->randomFloat(2, 500, 30000),
            'address' => $this->faker->address(),
            'phone' => $this->faker->unique()->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}