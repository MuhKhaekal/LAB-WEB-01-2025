<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\GaleriController;

// Route::get('/', [HalamanController::class, 'home']);
Route::get('/', [HalamanController::class, 'home'])->name('home');
Route::get('/destinasi', [HalamanController::class, 'destinasi']) ->name('destinasi');
Route::get('/kuliner', [HalamanController::class, 'kuliner'])->name('kuliner');
Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [HalamanController::class, 'kontak'])->name('kontak');

