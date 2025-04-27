<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    protected $fillable=[
        'make',
        'model',
        'year',
        'vin',
        'year',
        'vehicle_type_id',
        'status'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function vehicleType(){
        
        return $this->belongsTo(VehicleType::class);
    }
}
