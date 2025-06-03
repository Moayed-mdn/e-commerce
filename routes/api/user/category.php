<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->prefix('user')->middleware(['auth:sanctum','can:isUser'])->group(function (){

    Route::get('/categories','getCategoriesForUser');
    Route::get('/categories/{category}','show');

});