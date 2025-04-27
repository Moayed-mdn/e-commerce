<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;




    public function city(){

        return $this->belongsTo(City::class);
    }

    public function orders(){

        return $this->hasMany(Order::class);
    }

    



}
