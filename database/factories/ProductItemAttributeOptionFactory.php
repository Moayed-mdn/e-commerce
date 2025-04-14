<?php
namespace Database\Factories;

use App\Models\ProductItem;
use App\Models\ProductAttributeOption;

use Illuminate\Database\Eloquent\Factories\Factory;


class ProductItemAttributeOptionFactory extends Factory
{

    public function definition()
    {
        return [
            'product_item_id' => ProductItem::factory(), 
            'product_attribute_option_id' => ProductAttributeOption::factory(), 

        ];
    }
}
