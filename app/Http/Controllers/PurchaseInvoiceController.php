<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseInvoice\StorePurchaseInvoiceRequest;
use App\Http\Requests\UpdatePurchaseInvoiceRequest;
use App\Http\Resources\PurchaseInvoiceResource;
use App\Models\PurchaseInvoice;
use App\Services\PurchaseInvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class PurchaseInvoiceController extends Controller
{

    public function __construct(protected PurchaseInvoiceService $purchaseInvoiceService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseInvoices=$this->purchaseInvoiceService->index();

        return $this->paginateSuccessResponse(__('message.done'),PurchaseInvoiceResource::collection($purchaseInvoices));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseInvoiceRequest $request)
    {
       

        DB::beginTransaction();

        $purchaseInvoice=$this->purchaseInvoiceService->store($request);
        
        $this->purchaseInvoiceService->addDetails($request,$purchaseInvoice);


        DB::commit();


        return $this->dataSuccessResponse(__('message.done.added'),'',new PurchaseInvoiceResource($purchaseInvoice));



    }

 
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseInvoiceRequest $request, PurchaseInvoice $purchaseInvoice)
    {

        DB::beginTransaction();

        $purchaseInvoice=$this->purchaseInvoiceService->update($request,$purchaseInvoice);
        
        $this->purchaseInvoiceService->updateDetails($request,$purchaseInvoice);


        DB::commit();


        return $this->dataSuccessResponse(__('message.done.updated'),'',new PurchaseInvoiceResource($purchaseInvoice));



    }

    public function show(PurchaseInvoice $purchaseInvoice){

        return $this->dataSuccessResponse(__('message.done'),'',new PurchaseInvoiceResource($purchaseInvoice));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseInvoice $purchaseInvoice)
    {
        
    }
}
