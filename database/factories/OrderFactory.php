<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\DeliveryBoy;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->unique()->numerify('ORDER#####'), 
            'user_id' => User::factory(), 
            'status' => $this->faker->randomElement(['pending', 'processing', 'delivered', 'cancelled']),
            'address_id' => Address::factory(), 
            'payment_method_id' => PaymentMethod::factory()->createDefaultMethods(), 
            'delivery_boy_id' => DeliveryBoy::factory(), 
            'vehicle_id' => Vehicle::factory(), 
            'total' => $this->faker->randomFloat(2, 10, 1000), 
        ];
    }
}
