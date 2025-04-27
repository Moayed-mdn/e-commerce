<?php

use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('staff/vehicle-types',VehicleTypeController::class)->middleware(['auth:sanctum','can:isAdmin']);