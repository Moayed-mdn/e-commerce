<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::resource('staff/suppliers',SupplierController::class)->middleware(['auth:sanctum','can:isAdmin']);

