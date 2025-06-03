<?php

namespace App\Services;

use App\Models\ProductAttributeOption;
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

        $validatedData = $detail;
        unset($validatedData['product_image']);
        
        if (isset($detail['product_image']) && $detail['product_image'] instanceof \Illuminate\Http\UploadedFile) {
            $file = $detail['product_image'];
            $path = $file->store('productItem', 'public');
            $validatedData['product_image'] = $path;
        }


        $productItem=ProductItem::create($validatedData);

        if(isset($detail['attributes']))
            $this->addAttributesToProductItem($detail['attributes'],$productItem);


        return $productItem;
        


    }

    public function addAttributesToProductItem($attributes,$productItem){

            foreach($attributes as $attribute){
                $productAttributeOption=ProductAttributeOption::where('product_attribute_id',$attribute['id'])
                    ->where('value',$attribute['value'])
                    ->first();

                if(!$productAttributeOption)
                    $productAttributeOption= ProductAttributeOption::create([
                        'product_attribute_id'=>$attribute['id'],
                        'value'=>$attribute['value']
                    ]);
                

                $productItem->attributeOptions()->attach($productAttributeOption->id);
            }

    }


   public function updateProductItemAttributes($attributes, $productItem){
    
    $attributeOptionIds = [];

   
    foreach ($attributes as $attribute) {

        
        
        $productAttributeOption = ProductAttributeOption::where('product_attribute_id', $attribute['id'])
            ->where('value', $attribute['value'])
            ->first();

    
        if (!$productAttributeOption) {
            $productAttributeOption = ProductAttributeOption::create([
                'product_attribute_id' => $attribute['id'],
                'value' => $attribute['value']
            ]);
        }
    
       
        $attributeOptionIds[] = $productAttributeOption->id;
    }

    
    $productItem->attributeOptions()->sync($attributeOptionIds);

    }


    public function createPurchaseInvoiceDetail(PurchaseInvoice $purchaseInvoice,ProductItem $productItem,$detail):PurchaseInvoiceDetail{

        return PurchaseInvoiceDetail::create([
            'purchase_invoice_id' => $purchaseInvoice->id,
            'product_item_id' => $productItem->id,
            'quantity' => $detail['quantity'],
            'unit_cost' => $detail['unit_cost'],
        ]);

    }

    public function updateProductItem(ProductItem $productItem,PurchaseInvoice $purchaseInvoice,$detail):ProductItem{
      
        
        if(isSet($detail['attributes']))
            $this->updateProductItemAttributes($detail['attributes'],$productItem);

        $purchaseInvoiceDetail=PurchaseInvoiceDetail::where('purchase_invoice_id',$purchaseInvoice->id)->where('product_item_id',$productItem->id)->first();
            
        $productItem->update([  /// 100 
            'product_id' => $detail['product_id'] ?? $productItem->product_id, 
            'quantity' => isSet($detail['quantity']) ? ($productItem->quantity -  $purchaseInvoiceDetail->quantity) + $detail['quantity'] : $productItem->quantity , 
            'price' => $detail['price']  ?? $productItem->product_id, 
            'mfg' => $detail['mfg']  ?? $productItem->mfg,
            'exp' => $detail['exp']  ?? $productItem->exp ,
        ]);

        

        return $productItem;
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
                $productItem->quantity += $detail['quantity'];
                $productItem->save();
            } else { 
                
                $productItem=$this->createProductItem($detail);

            }
            
           $this->createPurchaseInvoiceDetail($purchaseInvoice,$productItem,$detail);

            
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


                $purchaseInvoiceDetail=PurchaseInvoiceDetail::where('purchase_invoice_id',$purchaseInvoice->id)->where('product_item_id',$productItem->id)->first();
                

                $this->updatePurchaseInvoiceDetail($purchaseInvoiceDetail,$detail);
             
                
            }


    }

}