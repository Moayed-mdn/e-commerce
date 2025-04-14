<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


    Route::resource('staff/categories', CategoryController::class)->middleware('auth:sanctum');

