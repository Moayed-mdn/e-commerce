<?php

namespace App\Services;

use App\Enums\VehicleStatus;
use App\Models\Vehicle;

class VehicleService{

    public function index($request){

        $query=Vehicle::query();

        if($request->has('status')&&in_array($request->status,VehicleStatus::getStatus()))
            $query->where('status',$request->status);

        return $query->get();

    }

    public function store($request){

        return Vehicle::create($request->validated());
                
    }

    public function update($request,Vehicle $vehicle){

        return $vehicle->update($request->validated());
                
    }
 


}