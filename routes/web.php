<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MovieController;
use App\Http\Controllers\Web\BookingController;


use App\Http\Controllers\Web\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Register
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// Home
Route::get('/', [HomeController::class, 'index']);

// Movie
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);

// Booking
Route::middleware('auth')->group(function () {
    Route::get('/booking/{showtimeId}', [BookingController::class, 'create']);
    Route::post('/booking', [BookingController::class, 'store']);
});
