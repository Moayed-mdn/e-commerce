<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAttributeOption\DeleteProductAttributeOptionRequest;
use App\Http\Requests\ProductAttributeOption\GetProductAttributeOptionRequest;
use App\Http\Requests\ProductAttributeOption\StoreProductAttributeOptionRequest;
use App\Http\Requests\ProductAttributeOption\UpdateProductAttributeOptionRequest;
use App\Http\Resources\ProductAttributeOptionResource;
use App\Models\ProductAttributeOption;
use App\Services\ProductAttributeOptionService;
use Illuminate\Http\Request;

class ProductAttributeOptionController extends Controller
{

    public function __construct(protected ProductAttributeOptionService $productAttributeOptionService){}
    /**
     * Display a listing of the resource.
     */
    public function index(GetProductAttributeOptionRequest $request)
    {
        $productAttributeOptions=$this->productAttributeOptionService->getProductAttributeOptionForStaff();
        
        return $this->paginateSuccessResponse(__('message.done'), ProductAttributeOptionResource::collection($productAttributeOptions));

    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductAttributeOptionRequest $request)
    {   
        $productAttributeOption=$this->productAttributeOptionService->addProductAttributeOption($request);


        return $this->dataSuccessResponse(__('message.done.added'),'',new ProductAttributeOptionResource($productAttributeOption));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttributeOption $productAttributeOption)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new ProductAttributeOptionResource($productAttributeOption));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductAttributeOptionRequest $request, ProductAttributeOption $productAttributeOption)
    {
        $productAttributeOption=$this->productAttributeOptionService->updateProductAttributeOption($request,$productAttributeOption);

        return $this->dataSuccessResponse(__('message.done.updated'),'',new ProductAttributeOptionResource($productAttributeOption));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteProductAttributeOptionRequest $request,ProductAttributeOption $productAttributeOption)
    {
        $this->productAttributeOptionService->deleteProductAttributeOption($productAttributeOption);

        return $this->successResponse(__('message.done.deleted'));
    }

}
