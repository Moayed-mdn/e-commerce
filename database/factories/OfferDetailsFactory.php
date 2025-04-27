<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\ProductItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfferDetails>
 */
class OfferDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'offer_id' => Offer::factory(), 
            'product_item_id' => ProductItem::factory(), 
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
