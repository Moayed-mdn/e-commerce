<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    /** @use HasFactory<\Database\Factories\ProductAttributeFactory> */
    use HasFactory;

    protected $fillable=[
        "category_id",
        "name"

    ];

    public function category(){
        return $this->belongsTo(Category::class);

    }

    public function productAttriubteOptions(){
        return $this->hasMany(ProductAttributeOption::class);
    }
}
