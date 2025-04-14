<?php

use App\Http\Controllers\DeliveryBoyController;
use Illuminate\Support\Facades\Route;

Route::controller(DeliveryBoyController::class)->prefix('delivery-boy')->group(function (){
    Route::post('/login','login');
});