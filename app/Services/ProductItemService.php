<?php

namespace App\Services;

use App\Models\ProductItem;

class ProductItemService{


    public function getProdutItemsForStaff(){

        return ProductItem::all();

    }    

    public function addProductItem($request):ProductItem
    {   
        $productItem= ProductItem::create($request->except('attribute_option_ids'));

        if($request->validated('attribute_option_ids'))
           $productItem= $this->addAttributeOptionToProductItem($request,$productItem);


        return $productItem;  
        

    }

    public function updateProductItem($request,ProductItem $productItem):ProductItem{

        $productItem->update($request->validated());

        if($request->except('attribute_option_ids'))
            $productItem= $this->addAttributeOptionToProductItem($request,$productItem);

        return $productItem;


    }

    public function deleteProductItem(ProductItem $productItem){

        return $productItem->delete();

    }

    public function addAttributeOptionToProductItem($request,ProductItem $productItem):ProductItem{


        $product_attribute_option_ids=$request->validated('attribute_option_ids');


        $productItem->attributeOptions()->attach($product_attribute_option_ids);


        return $productItem;
    }


}