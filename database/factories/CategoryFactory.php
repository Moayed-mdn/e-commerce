<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        return [
            'name' => $this->faker->unique()->words(2, true),
            'parent_id' => null, 
        ];
    }

    
    public function child(Category $parent) 
    {
        return $this->state(function (array $attributes) use ($parent) { 
            return [
                'parent_id' => $parent->id, 
            ];
        });
    }
}
