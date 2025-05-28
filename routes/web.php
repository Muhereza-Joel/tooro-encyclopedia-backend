<?php

use App\Http\Controllers\PesaPalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::post('/pesapal/callback', [PesaPalController::class, 'callback'])->name('pesapal.callback');
Route::post('/pesapal/ipn', [PesaPalController::class, 'ipn'])->name('pesapal.ipn');
