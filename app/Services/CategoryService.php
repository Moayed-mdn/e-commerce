<?php

namespace App\Services;

use App\Models\Category;

class CategoryService {

    public function getCategoriesForStaff(){
        
        return  Category::all();


    }

    public function addCategory($request){

       return Category::create($request->validated());

    }

    public function updateCategory($request,$category){
      

        $category->update($request->validated());

        return $category;

    }


    public function deleteCategory($category){
    
        $check=$category->delete();

        return $check;
    }



}