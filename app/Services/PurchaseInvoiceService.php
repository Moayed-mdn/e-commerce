<?php

namespace App\Services;

use App\Models\ProductItem;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceDetail;

class PurchaseInvoiceService {

    public function index(){
        
        return  PurchaseInvoice::paginate();


    }

    public function store($request){

        return  PurchaseInvoice::create([
            'invoice_number' => $request->invoice_number,
            'supplier_id' => $request->supplier_id,
        ]);
    }

    public function update($request,PurchaseInvoice $purchaseInvoice){
      

        $purchaseInvoice->update($request->validated());

        return $purchaseInvoice;

    }

    public function createProductItem($detail):ProductItem{

        return ProductItem::create([
            'product_id' => $detail['product_id'], 
            'quantity' => 0, 
            'price' => $detail['price'], 
            'mfg' => $detail['mfg'],
            'exp' => $detail['exp'],
            
        ]);


    }

    public function createPurchaseInvoiceDetail(PurchaseInvoice $purchaseInvoice,ProductItem $productItem,$detail):PurchaseInvoiceDetail{

        return PurchaseInvoiceDetail::create([
            'purchase_invoice_id' => $purchaseInvoice->id,
            'product_item_id' => $productItem->id,
            'quantity' => $detail['quantity'],
            'unit_cost' => $detail['unit_cost'],
        ]);

    }

    public function updateProductItem(ProductItem $productItem,PurchaseInvoice $purchaseInvoice,$detail):bool{
      
        return $productItem->update([
            'product_id' => $detail['product_id'] ?? $productItem->product_id, 
            'quantity' => $detail['quantity'] ? $productItem->quantity -  $purchaseInvoice->quantity + $detail['quantity'] : $detail['quantity'] , 
            'price' => $detail['price']  ?? $productItem->product_id, 
            'mfg' => $detail['mfg']  ?? $productItem->mfg,
            'exp' => $detail['exp']  ?? $productItem->exp ,
        ]);
    }

    public function updatePurchaseInvoiceDetail(PurchaseInvoiceDetail $purchaseInvoiceDetail,$detail):bool{

        return $purchaseInvoiceDetail->update([ 
            'quantity' => $detail['quantity'] ?? $purchaseInvoiceDetail->quantity ,
            'unit_cost' => $detail['unit_cost'] ?? $purchaseInvoiceDetail->unit_cost ,
        ]);

    }

    public function addDetails($request,PurchaseInvoice $purchaseInvoice){

        foreach ($request->purchase_invoice_details as $detail) {
            if (isset($detail['product_item_id'])) {  
                $productItem = ProductItem::findOrFail($detail['product_item_id']);
            } else { 
                
                $productItem=$this->createProductItem($detail);

            }
            
           $this->createPurchaseInvoiceDetail($purchaseInvoice,$productItem,$detail);

            
            $productItem->quantity += $detail['quantity'];
            $productItem->save();
        }
    }


    public function updateDetails($request,$purchaseInvoice){

        if($request->purchase_invoice_details)
            foreach ($request->purchase_invoice_details as $detail) {
                if ($detail['product_item_id']) {  
                    $productItem = ProductItem::findOrFail($detail['product_item_id']);

                    $this->updateProductItem($productItem,$purchaseInvoice,$detail);
                }
                else{

                    $productItem=$this->createProductItem($detail);


                }


                $purchaseInvoiceDetail=PurchaseInvoiceDetail::where('product_item_id',$productItem->id)->first();
                

                $this->updatePurchaseInvoiceDetail($purchaseInvoiceDetail,$detail);
             
                
            }


    }

}