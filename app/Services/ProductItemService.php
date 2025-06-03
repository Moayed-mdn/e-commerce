<?php

namespace App\Services;

use App\Models\ProductItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductItemService{


    public function getProdutItemsForStaff(){

        return ProductItem::paginate();

    }    

    public function addProductItem($request):ProductItem
    {   



        $validatedData = $request->except('product_image'); 

        if ($request->hasFile('product_image')) {
            $path = $request->file('product_image')->store('productItem', 'public');
            $validatedData['product_image'] = $path;
        }

        $productItem = ProductItem::create($validatedData);

        return $productItem;  
        
        
        
        


        
        

    }

    public function updateProductItem($request,ProductItem $productItem):ProductItem{

        $validated=$request->validated();
        
        if($request->hasFile('product_image')){

           if($productItem->product_image&&Storage::disk('public')->exists($productItem->product_image)&&$productItem->product_image!='productItem/default.png'){
               Storage::disk('public')->delete($productItem->product_image);
           }

            $path=$request->file('product_image')->store('productItem','public');
            $validated['product_image']=$path;
            Log::alert("path: $path");
        }

        $productItem->update($validated);

        if($request->except('attribute_option_ids'))
            $productItem= $this->addAttributeOptionToProductItem($request,$productItem);

        return $productItem;
        

    }

    public function deleteProductItem(ProductItem $productItem){

        return $productItem->delete();

    }

    public function addAttributeOptionToProductItem($request,ProductItem $productItem):ProductItem{


        $product_attribute_option_ids=$request->validated('attribute_option_ids');


        $productItem->attributeOptions()->sync($product_attribute_option_ids);


        return $productItem;
    }


}