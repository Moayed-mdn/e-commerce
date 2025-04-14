<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::resource('staff/products',ProductController::class)->middleware('auth:sanctum');
