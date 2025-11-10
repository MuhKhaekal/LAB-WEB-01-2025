<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishController;

Route::get('/', [FishController::class, 'home'])->name('home');

Route::resource('fishes', FishController::class);