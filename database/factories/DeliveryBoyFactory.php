<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryBoy>
 */
class DeliveryBoyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName(),
            'phone_number' => $this->faker->unique()->phoneNumber,
            'password' => Hash::make('12345678'),
            'birth_date' => $this->faker->date('Y/m/d'),
            'gender' => $this->faker->randomElement(['male', 'female']),
        ];    }
}
