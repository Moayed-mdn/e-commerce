<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseInvoiceFactory> */
    use HasFactory;

    protected $fillable=[
        'invoice_number',
        'supplier_id',
    ];

    public function supplier(){
        
        return $this->belongsTo(Supplier::class);
    } 

    public function purchaseInvoiceDetails(){
        
        return $this->hasMany(PurchaseInvoiceDetail::class);
    }


}
