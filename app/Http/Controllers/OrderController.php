<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrdersForStaff(){
        $data=[
            ['name'=>'moaed'],
            ['name'=>'moaed'],
            ['name'=>'moaed'],

        ];

        return $this->dataSuccessResponse('this message','',$data);


    }
}
