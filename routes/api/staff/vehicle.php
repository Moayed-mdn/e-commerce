<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::resource('staff/vehicles',VehicleController::class)->middleware(['auth:sanctum','can:isAdmin']);