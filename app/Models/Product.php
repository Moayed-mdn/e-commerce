<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable=[
        "name",
        "brand_id",
        "category_id",
        "product_image",
        "descriptoin"
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function brand(){
        
        return $this->belongsTo(Brand::class);
    }

    public function productItems(){
        return $this->hasMany(ProductItem::class);
    }

    public function offers(){
        return $this->hasMany(Offer::class);
    }


}
