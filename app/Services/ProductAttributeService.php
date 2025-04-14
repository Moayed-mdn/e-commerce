<?php

namespace App\Services;

use App\Models\ProductAttribute;

class ProductAttributeService{


    public function getProductAttributeForStaff(){

        return ProductAttribute::all();
    }    

    public function addProductAttribute($request):ProductAttribute
    {

       return  ProductAttribute::create($request->validated());

    }

    public function updateProductAttribute($request,ProductAttribute $productAttribute){

        $productAttribute->update($request->validated());

        return $productAttribute;


    }

    public function deleteProductAttribute(ProductAttribute $productAttribute){

        return $productAttribute->delete();

    }




}