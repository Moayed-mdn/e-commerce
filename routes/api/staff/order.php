<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::controller(OrderController::class)->prefix('staff')->middleware('auth:sanctum')->group(function (){

Route::get('/order','getOrdersForStaff');



});