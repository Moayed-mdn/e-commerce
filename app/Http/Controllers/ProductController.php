<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\DeleteProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(protected ProductService $productService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=$this->productService->getProductsForStaff();

        return $this->dataSuccessResponse(__('message.done'),'',ProductResource::collection($products));

    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product= $this->productService->addproduct($request);


        return $this->dataSuccessResponse(__('message.done.added'),'',new ProductResource($product));

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new ProductResource($product));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product=$this->productService->updateProduct($request,$product);

        return $this->dataSuccessResponse(__('message.done.updated'),'',new ProductResource($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteProductRequest $request,Product $product)
    {

        $this->productService->deleteProduct($product);

        return $this->successResponse(__('message.done.deleted'));
    }
}
