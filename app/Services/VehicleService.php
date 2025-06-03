<?php

namespace App\Services;

use App\Enums\VehicleStatus;
use App\Models\Vehicle;

class VehicleService{

    public function index(){

        

      

        return  Vehicle::paginate() ;

    }

    public function store($request){

        return Vehicle::create($request->validated());
                
    }

    public function update($request,Vehicle $vehicle){

        return $vehicle->update($request->validated());
                
    }
 


}