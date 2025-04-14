<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferDetails extends Model
{
    
    protected $fillable=[
        "offer_id",
        "product_item_id",
        "quantity"
    ];  

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function productItem(){
        return $this->belongsTo(ProductItem::class);
    }

}
