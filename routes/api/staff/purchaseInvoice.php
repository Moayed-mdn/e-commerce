<?php

use App\Http\Controllers\PurchaseInvoiceController;
use Illuminate\Support\Facades\Route;

Route::resource('staff/purchase-invoices',PurchaseInvoiceController::class)->middleware(['auth:sanctum','can:isAdmin']);



