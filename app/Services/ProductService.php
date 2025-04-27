<?php

namespace App\Services;

use App\Models\Product;

class ProductService {

    public function getProductsForStaff(){
        
        return Product::paginate();

    }


    public function addProduct($request){

        return Product::create($request->validated());

    }

    public function updateProduct($request,Product $product):Product{

        $product->update($request->validated());

        return $product;

    }

    public function deleteProduct(Product $product):bool{

        return $product->delete();

    }



}