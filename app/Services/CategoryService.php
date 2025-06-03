<?php

namespace App\Services;

use App\Models\Category;
use App\Models\ProductAttribute;

class CategoryService {

    public function getCategoriesForStaff(){
        
        return  Category::paginate();


    }


    public function getCategoriesForUser(){
        
        return  Category::all();


    }

    public function addCategory($request){
        
        $category= Category::create($request->validated());
        
        
        
        
        if($request->has('product_attributes'))
            $this->addProductAttribures($request,$category);


        return $category;

    }

    public function updateCategory($request,$category){
      
       $data = [];
    
        if ($request->has('name')) {
            $data['name'] = $request->name;
        }
        
        if ($request->has('parent_id')) {
            $data['parent_id'] = $request->parent_id =="no_parent"?null:$request->parent_id;
        }
        
        $category->update($data);

        if($request->has('product_attributes'))
            $this->updateProductAttribures($request,$category);


        return $category;

    }

    public function deleteCategory($category){
    
        $check=$category->delete();

        return $check;
    }

    public function addProductAttribures($request,$category){

        foreach($request->product_attributes as $product_attribute){

            if (!empty($product_attribute['name'])) {
                $productAttribute = ProductAttribute::create([
                    'name' => $product_attribute['name'], 
                    'category_id' => $category->id,       
                ]);
        }
        }
      


    }

     public function updateProductAttribures($request,$category){

        
        foreach($category->productAttributes as $productAttribute){
            $productAttribute->category_id=null;
            $productAttribute->save();
        }
      
        $this->addProductAttribures($request,$category);

    }


}