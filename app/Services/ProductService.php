<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService {

    public function getProductsForStaff(){
        
        return Product::paginate();

    }


    public function getProductsForUser($request){

        $query = Product::query();

        
        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }


        
        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm);
            });
        }

       

        
        $limit = $request->input('limit', 10);
        $products = $query->paginate($limit);


        return $products;
        
    
    }

    public function homepageProducts($request){

        $limit = $request->input('limit', 8); 

        
        
        
        
        


        $products = Product::with(['category', 'brand', 'productItems'])
                           ->inRandomOrder()
                           ->limit($limit)
                           ->get();

        return $products;
    }

    public function addProduct($request){

        $valiadated=$request->validated();

        if($request->hasFile('product_image')){ 
            $path=$request->file('product_image')->store('product','public');
            $valiadated['product_image']=$path;
        }

        return Product::create($valiadated);

    }

    public function updateProduct($request,Product $product):Product{

        $valiadated=$request->validated();

        if($request->hasFile('product_image')){ 

             if ($product->product_image && Storage::disk('public')->exists($product->product_image &&$product->product_image!='product/default.png ')) {
                Storage::disk('public')->delete($product->product_image);
            }

            $path=$request->file('product_image')->store('product','public'); 
            $valiadated['product_image']=$path;
        }


        $product->update($valiadated);

        return $product;

    }

    public function deleteProduct(Product $product):bool{

        return $product->delete();

    }



}