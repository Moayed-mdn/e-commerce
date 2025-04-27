<?php

namespace Database\Factories;

use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->company(), 
            'model' => $this->faker->word(), 
            'year' => $this->faker->numberBetween(2000, 2024), 
            'vin' => $this->faker->unique()->regexify('[A-Z0-9]{17}'), 
            'vehicle_type_id' => VehicleType::factory(), 
            'status' => $this->faker->randomElement(['available', 'in_use', 'maintenance', 'out_of_service']), 
        ];
    }
}
