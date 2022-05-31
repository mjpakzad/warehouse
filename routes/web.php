<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('app.index');
Route::post('/', [AppController::class, 'process'])->name('app.process');
