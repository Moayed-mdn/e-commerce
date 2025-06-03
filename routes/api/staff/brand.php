<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

Route::resource('staff/brands',BrandController::class)->middleware(['auth:sanctum','can:isAdmin']);

