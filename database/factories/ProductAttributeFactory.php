<?php
namespace Database\Factories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductAttributeFactory extends Factory
{
   

    public function definition()
    {
        return [
            'category_id' => Category::factory(), 
            'name' => $this->faker->unique()->word,
        ];
    }
}
