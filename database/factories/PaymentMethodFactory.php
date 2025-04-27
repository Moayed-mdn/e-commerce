<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->unique()->word, 
        ];
    }

    public static function createDefaultMethods()
    {
        $methods = ['Cache'];
        
        foreach ($methods as $method) {
           $paymentMethod= PaymentMethod::firstOrCreate(['type' => $method]);
        }

        return $paymentMethod;
    }
}
