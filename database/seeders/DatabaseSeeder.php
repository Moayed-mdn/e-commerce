<?php



use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeOption;
use App\Models\ProductItemAttributeOption;
use Database\Seeders\RoleSeeder;
use Database\Seeders\StaffSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
                
        
        
        
         $this->call([
            RoleSeeder::class,
            StaffSeeder::class
        ]);


        
        $topLevelCategories = Category::factory()->count(3)->create();

        $topLevelCategories->each(function ($category) {
            Category::factory()->count(3)->for($category, 'parent')->create();
        });

        
        Brand::factory()->count(1)->create(); 


        
        Product::factory()->count(10)->create(); 

        
        
        Product::all()->each(function ($product) {
            ProductItem::factory()->count(3)->create(['product_id' => $product->id]);
        });

        
        
        
        Category::all()->each(function ($category) {
             ProductAttribute::factory()->count(2)->create(['category_id' => $category->id]);
        });

        
        
         ProductAttribute::all()->each(function ($attribute) {
              ProductAttributeOption::factory()->count(3)->create(['product_attribute_id' => $attribute->id]);
         });

        
         ProductItem::all()->each(function ($productItem) {
            ProductAttributeOption::all()->random(2)->each(function ($attributeOption) use ($productItem) {
                $productItem->attributeOptions()->sync($attributeOption);
           });
       });

       


    }
}