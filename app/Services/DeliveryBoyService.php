<?php

namespace App\Services;

use App\Models\DeliveryBoy;
use Illuminate\Support\Facades\Hash;

class DeliveryBoyService{
    
    public function login($request):DeliveryBoy|null{
        
        $deliveryBoy=DeliveryBoy::where('username',$request->username)->first();

        if($deliveryBoy&&Hash::check($request->password,$deliveryBoy->password)){
                return $deliveryBoy;
        }

        return null;


    }

    public function index()
    {
        return DeliveryBoy::paginate(); 
    }

    public function store($request):DeliveryBoy
    {
        return DeliveryBoy::create($request->validated());
    }

    public function update($request, DeliveryBoy $deliveryBoy):bool
    {
           
      return  $deliveryBoy->update($request->validated());

    }

    public function delete(DeliveryBoy $deliveryBoy):bool
    {

        return $deliveryBoy->delete(); 
    }



}

