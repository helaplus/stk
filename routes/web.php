<?php

use Illuminate\Support\Facades\Route;
use Helaplus\Stk\Http\Controllers\StkController;

Route::post('/stk/receiver', [StkController::class, 'receiver'])->name('payment.receiver');