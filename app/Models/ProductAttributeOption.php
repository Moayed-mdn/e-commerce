<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeOption extends Model
{
    /** @use HasFactory<\Database\Factories\ProductAttributeOptionFactory> */
    use HasFactory;
   
    protected $fillable=[
        'product_attribute_id',
        'value'
    ];


    
    public function productAttribute(){
        return $this->belongsTo(ProductAttribute::class);
    }

    public function productItems(){
        return $this->belongsToMany(ProductItem::class,'product_item_attribute_options','product_attribute_option_id','product_item_id');
    }
}
