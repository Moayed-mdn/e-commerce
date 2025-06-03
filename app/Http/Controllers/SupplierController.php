<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Services\SupplierService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{

    public function __construct(protected SupplierService $supplierService )
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers=$this->supplierService->getSuppliersForStaff();

        return $this->paginateSuccessResponse(__('message.done'), SupplierResource::collection($suppliers));



    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request){
      
        DB::beginTransaction();

        $supplier=$this->supplierService->addSupplier($request);
        $this->attachCommunicationMethodsToSupplier($request,$supplier);
        
        DB::commit();

        return $this->dataSuccessResponse(__('message.done.created'),'',new SupplierResource($supplier));
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new SupplierResource($supplier) );
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $this->supplierService->updateSupplier($request,$supplier);
        
        
        $this->updateCommunicationMethodsToSupplier($request,$supplier);



        return $this->dataSuccessResponse(__('message.done.updated'),'',new SupplierResource($supplier));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {   
        $this->supplierService->deleteSupplier($supplier);
        
        return $this->successResponse(__('message.done.deleted'));
    }

    protected  function attachCommunicationMethodsToSupplier($request,Supplier $supplier){

        $communicationMethodsData = [];
     
        foreach ($request->communication_methods as $method) {
            $communicationMethodId = $method['communication_method_id'];
            $contactDetail = $method['contact_detail'];


            $communicationMethodsData[$communicationMethodId] = ['contact_detail' => $contactDetail];

        }

        $supplier->communicationMethods()->attach($communicationMethodsData);
    }

    protected  function updateCommunicationMethodsToSupplier($request,Supplier $supplier){
       
        if ($request->has('communication_methods')) {
           
            $communicationMethodsData = [];
    
            foreach ($request->communication_methods as $method) {
                $communicationMethodId = $method['communication_method_id'];
                $contactDetail = $method['contact_detail'];
    
                
                $communicationMethodsData[$communicationMethodId] = ['contact_detail' => $contactDetail];
            }
    
            
            $supplier->communicationMethods()->sync($communicationMethodsData);
        }
    }

}
