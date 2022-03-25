<?php

use Illuminate\Support\Facades\Route;
use Helaplus\Stk\Http\Controllers\StkController;

Route::post('/stk/paymentReceiver', [StkController::class, 'paymentReceiver'])->name('payment.receiver');