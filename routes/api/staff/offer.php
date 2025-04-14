<?php

use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;


Route::resource('staff/offers',OfferController::class)->middleware('auth:sanctum');
