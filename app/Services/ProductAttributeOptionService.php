<?php

namespace App\Services;

use App\Models\ProductAttributeOption;

class ProductAttributeOptionService{

    
    public function getProductAttributeOptionForStaff(){

        return ProductAttributeOption::all();
    }    

    public function addProductAttributeOption($request):ProductAttributeOption
    {

       return  ProductAttributeOption::create($request->validated());

    }

    public function updateProductAttributeOption($request,ProductAttributeOption $productAttributeOption){

        $productAttributeOption->update($request->validated());

        return $productAttributeOption;


    }

    public function deleteProductAttributeOption(ProductAttributeOption $productAttributeOption){

        return $productAttributeOption->delete();

    }




}