<?php

namespace App\Services;

use App\Models\VehicleType;

class VehicleTypeService{

    public function index(){

        return VehicleType::all();

    }

    public function store($request){

        return VehicleType::create($request->validated());
                
    }

    public function update($request,VehicleType $vehicle){

        return $vehicle->update($request->validated());
                
    }
 
  


}