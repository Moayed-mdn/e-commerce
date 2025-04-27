<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    protected $fillable=[
        'name', 
        'address',
        'description'
    ];

    
    public function communicationMethods(){
        
        return $this->belongsToMany(CommunicationMethod::class)->withPivot('contact_detail');
    }
}
