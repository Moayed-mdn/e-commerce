<?php

use App\Http\Controllers\ProductAttributeController;
use Illuminate\Support\Facades\Route;


Route::resource('staff/product_attributes',ProductAttributeController::class)->middleware('auth:sanctum','can:isAdmin');