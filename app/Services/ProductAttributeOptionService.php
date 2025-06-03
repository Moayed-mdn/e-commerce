<?php

namespace App\Services;

use App\Models\ProductAttributeOption;

class ProductAttributeOptionService{

    
    public function getProductAttributeOptionForStaff(){

        return ProductAttributeOption::orderBy('value','asc')->paginate();
    }    

    public function addProductAttributeOption($request):ProductAttributeOption
    {

      $productAttributeOption=  ProductAttributeOption::create($request->validated());


      $productAttributeOption->product_attribute_id=$request->product_attribute_id;

      return $productAttributeOption;

    }

    public function updateProductAttributeOption($request,ProductAttributeOption $productAttributeOption){

        $productAttributeOption->update($request->validated());

        return $productAttributeOption;


    }

    public function deleteProductAttributeOption(ProductAttributeOption $productAttributeOption){

        return $productAttributeOption->delete();

    }




}