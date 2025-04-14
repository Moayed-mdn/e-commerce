<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable=[
        "name",
        "percentage",
        "start_date",
        "end_date",
        "description"
    ];



    public function offerDetails(){
        return $this->hasMany(OfferDetails::class);
    }
}
