<?php

namespace Database\Factories;

use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductAttributeOptionFactory extends Factory
{

    public function definition()
    {
        return [
            'product_attribute_id' => ProductAttribute::factory(),
            'value' => $this->faker->unique()->word,
        ];
    }
}

