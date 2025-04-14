<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Requests\Brand\DeleteBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Services\BrandService;

class BrandController extends Controller
{

    public function __construct(protected BrandService $brandService ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=$this->brandService->getBrandsForStaff();

        return $this->dataSuccessResponse(__('message.done'),'', BrandResource::collection($categories));


    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request){
      
        $brand=$this->brandService->addBrand($request);
        
        return $this->dataSuccessResponse(__('message.done.created'),'',new BrandResource($brand));
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new BrandResource($brand) );
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {

        $brand=$this->brandService->updateBrand($request,$brand);


        return $this->dataSuccessResponse(__('message.done.updated'),'',new BrandResource($brand));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteBrandRequest $request,Brand $brand)
    {   
        $this->brandService->deleteBrand($brand);
        
        return $this->successResponse(__('message.done.deleted'));
    }
}
