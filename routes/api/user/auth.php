<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('/request-otp', 'requestOtp');
    Route::post('/verify-otp', 'verifyOtp');
    Route::post('/complete-profile','completeProfile')->middleware('profileIncomplete')->name('complete-profile');
    Route::put('/update', 'update')->middleware('auth:sanctum');
    Route::get('/logout', 'logout')->middleware('auth:sanctum');
});
