<?php

namespace Database\Factories;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductItemFactory extends Factory
{

    public function definition()
    {
        $mfg = $this->faker->dateTimeBetween('-1 year', 'now');
        $exp = $this->faker->dateTimeBetween('+1 month', '+2 years');

        return [
            'product_id' => Product::factory(), 
            'quantity' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->randomFloat(2, 10, 1000), 
            'product_image' =>'productItem/default.png', 
            'mfg' => $mfg->format('Y-m-d'), 
            'exp' => $exp->format('Y-m-d'), 
        ];
    }
}

