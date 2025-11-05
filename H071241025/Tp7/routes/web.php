<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\TourismController;
Route::get('/', [TourismController::class, 'home'])->name('home');
Route::get('/destinasi', [TourismController::class, 'destinasi'])->name('destinasi');
Route::get('/kuliner', [TourismController::class, 'kuliner'])->name('kuliner');
Route::get('/galeri', [TourismController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [TourismController::class, 'kontak'])->name('kontak');