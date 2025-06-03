<?php

namespace App\Services;

use App\Models\DeliveryBoy;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffService{

    public function login($request){

        $staff=Staff::where('username',$request->username)->where('is_active','1')->first();


        if($staff&&Hash::check($request->password,$staff->password))
            return $staff;

        return null;

    }







}