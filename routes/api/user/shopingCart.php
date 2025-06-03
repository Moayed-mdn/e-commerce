<?php

use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;

Route::controller(ShoppingCartController::class)->prefix('user')->middleware(['auth:sanctum','can:isUser'])->group(function (){

    Route::get('/shopping-carts','index');
    Route::post('/shopping-carts','store');


});