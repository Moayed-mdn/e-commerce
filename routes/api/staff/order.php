<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::controller(OrderController::class)->prefix('staff')->middleware(['auth:sanctum','can:isAdmin'])->group(function (){

Route::get('/orders','getOrdersForStaff');
Route::put('/orders/{order}','updateOrderByStaff');
});