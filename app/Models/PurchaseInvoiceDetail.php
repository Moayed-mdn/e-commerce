<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceDetail extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseInvoiceDetailFactory> */
    use HasFactory;

    protected $fillable=[
        
        'purchase_invoice_id',
        'product_item_id',
        'quantity',
        'unit_cost'
    ];

    public function purchaseInvoice(){
        
        return $this->belongsTo(PurchaseInvoice::class);
    }

    public function productItem(){
        
        return $this->belongsTo(ProductItem::class);
    }
}
