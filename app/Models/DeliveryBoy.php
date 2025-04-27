<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Laravel\Sanctum\HasApiTokens;

class DeliveryBoy extends User
{
    /** @use HasFactory<\Database\Factories\DeliveryBoyFactory> */
    use HasFactory,HasApiTokens;
    
    protected $fillable=[
        'first_name',
        'last_name',
        'username',
        'password',
        'birth_date',
        'gender',
        'phone_number',
        'is_active',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
