<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAttribute\DeleteProductAttributeRequest;
use App\Http\Requests\ProductAttribute\GetProductAttributeRequest;
use App\Http\Requests\ProductAttribute\StoreProductAttributeRequest;
use App\Http\Requests\ProductAttribute\UpdateProductAttributeRequest;
use App\Http\Resources\ProductAttributeResource;
use App\Models\ProductAttribute;
use App\Services\ProductAttributeService;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{

    public function __construct(protected ProductAttributeService $productAttributeService){}
    /**
     * Display a listing of the resource.
     */
    public function index(GetProductAttributeRequest $request)
    {
        $productAttributes=$this->productAttributeService->getProductAttributeForStaff();

        return $this->dataSuccessResponse(__('message.done'),'',ProductAttributeResource::collection($productAttributes));
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductAttributeRequest $request)
    {
        $productAttribute=$this->productAttributeService->addProductAttribute($request);


        return $this->dataSuccessResponse(__('message.done.added'),'',new ProductAttributeResource($productAttribute));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttribute $productAttribute)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new ProductAttributeResource($productAttribute));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductAttributeRequest $request, ProductAttribute $productAttribute)
    {
        $productAttribute=$this->productAttributeService->updateProductAttribute($request,$productAttribute);

        return $this->dataSuccessResponse(__('message.done.updated'),'',new ProductAttributeResource($productAttribute));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteProductAttributeRequest $request,ProductAttribute $productAttribute)
    {
        $this->productAttributeService->deleteProductAttribute($productAttribute);

        return $this->successResponse(__('message.done.deleted'));
    }

}
