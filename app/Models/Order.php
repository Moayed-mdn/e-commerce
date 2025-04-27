<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable=[
        'order_number',
        'user_id',
        'status',
        'address_id',
        'payment_method_id',
        'delivery_boy_id',
        'vehicle_id',
        'total'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function deliveryBoy(){
        return $this->belongsTo(DeliveryBoy::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    

    
}
