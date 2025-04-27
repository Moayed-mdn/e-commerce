<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    /** @use HasFactory<\Database\Factories\ProductItemFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'product_image',
        'mfg',
        'exp',
    ];

    protected $perPage=10;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function attributeOptions(){
        return $this->belongsToMany(ProductAttributeOption::class,'product_item_attribute_options','product_item_id','product_attribute_option_id');
    }

    public function offerDetails(){
        return $this->belongsTo(OfferDetails::class);
    }
}
