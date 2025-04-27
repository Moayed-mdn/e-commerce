<?php

namespace Database\Factories;

use App\Models\CommunicationMethod;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company(), 
            'address' => $this->faker->address(),
            'description' => $this->faker->paragraph(),
        ];
    }


    
    public function configure()
    {
        return $this->afterCreating(function (Supplier $supplier) {
            $communicationMethods = CommunicationMethod::inRandomOrder()->take(rand(1, 2))->get(); 

            foreach ($communicationMethods as $method) {
                $supplier->communicationMethods()->attach($method, [
                    'contact_detail' => $method=='email'? $this->faker->unique()->safeEmail() : $this->faker->unique()->phoneNumber()
                ]);
            }
        });
    }

}
