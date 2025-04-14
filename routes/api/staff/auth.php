<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::controller(StaffController::class)->prefix('staff')->group(function (){
    Route::get('/check-auth','checkAuth')->middleware('auth:sanctum');
    Route::post('/login','login');

});