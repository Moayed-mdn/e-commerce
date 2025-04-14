<?php

use App\Http\Controllers\ProductItemController;
use Illuminate\Support\Facades\Route;

Route::resource('staff/product_items',ProductItemController::class)->middleware('auth:sanctum');