<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    public function __construct(protected CategoryService $categoryService ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=$this->categoryService->getCategoriesForStaff();

        return $this->dataSuccessResponse(__('message.done'),'', CategoryResource::collection($categories));


    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request){
      
        $category=$this->categoryService->addCategory($request);
        
        return $this->dataSuccessResponse(__('message.done.created'),'',new CategoryResource($category));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->dataSuccessResponse(__('message.done'),'',new CategoryResource($category) );
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category=$this->categoryService->updateCategory($request,$category);


        return $this->dataSuccessResponse(__('message.done.updated'),'',new CategoryResource($category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCategoryRequest $request,Category $category)
    {   
        $this->categoryService->deleteCategory($category);
        
        return $this->successResponse(__('message.done.deleted'));
    }
}
