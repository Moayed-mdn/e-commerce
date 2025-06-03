<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->prefix('user')->group(function(){
    
    Route::get('/products/getHomePage','homePageProducts');
    Route::get('/products/{id}','showproductItems');
    Route::get('/products','getProductsdForUser');
    

})->middleware(['auth:sanctum','can:isUser']);