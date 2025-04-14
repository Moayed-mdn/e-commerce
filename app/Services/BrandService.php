<?php

namespace App\Services;

use App\Models\Brand;

class BrandService {

    public function getBrandsForStaff(){
        
        return  Brand::all();


    }

    public function addBrand($request){

       return Brand::create($request->validated());

    }

    public function updateBrand($request,$brand){
      

        $brand->update($request->validated());

        return $brand;

    }


    public function deleteBrand($brand){
    
        $check=$brand->delete();

        return $check;
    }



}