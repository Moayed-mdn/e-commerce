<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;


Route::controller(StaffController::class)->prefix('staff')->middleware(['auth:sanctum', 'can:isAdmin'])->group(function (){

    Route::get('/delivery-boys', 'indexDeliveryBoys'); 
    Route::post('/delivery-boys', 'createDeliveryBoy'); 
    Route::get('/delivery-boys/{deliveryBoy}', 'showDeliveryBoy'); 
    Route::put('/delivery-boys/{deliveryBoy}', 'updateDeliveryBoy'); 
    Route::delete('/delivery-boys/{deliveryBoy}', 'deleteDeliveryBoy'); 

});

