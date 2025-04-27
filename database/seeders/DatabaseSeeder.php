<?php



use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommunicationMethod;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeOption;
use App\Models\ProductItemAttributeOption;
use App\Models\Supplier;
use Database\Seeders\RoleSeeder;
use Database\Seeders\StaffSeeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
                
        
       
        
         $this->call([
            RoleSeeder::class,
            StaffSeeder::class
        ]);


        
        $topLevelCategories = Category::factory(3)->create();

        $topLevelCategories->each(function ($category) {
            Category::factory(3)->for($category, 'parent')->create();
        });

        
        Brand::factory(1)->create(); 


        
        Product::factory(10)->create(); 

        
        
        Product::all()->each(function ($product) {
            ProductItem::factory(3)->create(['product_id' => $product->id]);
        });

        
        
        
        Category::all()->each(function ($category) {
            ProductAttribute::factory(2)->create(['category_id' => $category->id]);
        });

        
        
        ProductAttribute::all()->each(function ($attribute) {
            ProductAttributeOption::factory(3)->create(['product_attribute_id' => $attribute->id]);
        });

        
        ProductItem::all()->each(function ($productItem) {
            ProductAttributeOption::all()->random(2)->each(function ($attributeOption) use ($productItem) {
                $productItem->attributeOptions()->sync($attributeOption);
            });
        });

        
        
        
        $faker->unique(true); 

        
        Order::factory(20)->create();
        
        CommunicationMethod::factory()->createDefaultMethods();

        Supplier::factory(2)->create();

    }
}