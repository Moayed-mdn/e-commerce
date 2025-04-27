<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductItem\DeleteProductItemRequest;
use App\Http\Requests\ProductItem\GetProductItemRequest;
use App\Http\Requests\ProductItem\StoreProductItemRequest;
use App\Http\Requests\ProductItem\UpdateProductItemRequest;
use App\Http\Resources\ProductItemResource;
use App\Models\ProductItem;
use App\Services\ProductItemService;

class ProductItemController extends Controller
{

    public function __construct(protected ProductItemService $productItemService){}
    /**
     * Display a listing of the resource.
     */
    public function index(GetProductItemRequest $request)
    {
        $productItems=$this->productItemService->getProdutItemsForStaff();

        return $this->paginateSuccessResponse(__('message.done'),ProductItemResource::collection($productItems));
    }

 
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductItemRequest $request)
    {   

        $productItem=$this->productItemService->addProductItem($request);


        return $this->dataSuccessResponse(__('message.done.added'),'',new ProductItemResource($productItem));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductItem $productItem)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new ProductItemResource($productItem));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductItemRequest $request, ProductItem $productItem)
    {
        $productItem=$this->productItemService->updateProductItem($request,$productItem);

        return $this->dataSuccessResponse(__('message.done.updated'),'',new ProductItemResource($productItem));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteProductItemRequest $request,ProductItem $productItem)
    {
        $this->productItemService->deleteProductItem($productItem);

        return $this->successResponse(__('message.done.deleted'));
    }
}
