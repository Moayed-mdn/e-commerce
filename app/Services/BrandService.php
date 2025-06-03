<?php

namespace App\Services;

use App\Models\Brand;

class BrandService {

    public function getBrandsForStaff(){
        
        return  Brand::paginate();


    }

    public function addBrand($request){

       return Brand::create($request->validated());

    }

    public function updateBrand($request,Brand $brand){
      

        $brand->update($request->validated());

        return $brand;

    }


    public function deleteBrand(Brand $brand){
    
        $check=$brand->delete();

        return $check;
    }



}