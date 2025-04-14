<?php

use App\Http\Controllers\ProductAttributeOptionController;
use Illuminate\Support\Facades\Route;

Route::resource('staff/product_attribute_options',ProductAttributeOptionController::class)->middleware('auth:sanctum');