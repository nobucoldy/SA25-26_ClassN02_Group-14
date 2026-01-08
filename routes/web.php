<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MovieController;
use App\Http\Controllers\Web\BookingController;
use App\Http\Controllers\Web\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- MOVIE ROUTES ---
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/upcoming', [MovieController::class, 'upcoming'])->name('movies.upcoming');
Route::get('/movies/status', [MovieController::class, 'index'])->name('movies.status');

// Phải để cái {id} này ở dưới cùng của nhóm movies
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');


// --- BOOKING ---
Route::middleware('auth')->group(function () {
    
    // 1. ĐƯA COMBO LÊN TRÊN ĐẦU (Để không bị lỗi 404)
    Route::get('/booking/combo', [BookingController::class, 'combo'])->name('booking.combo');

    // 2. ĐƯA {showtimeId} XUỐNG DƯỚI
    Route::get('/booking/{showtimeId}', [BookingController::class, 'create'])->name('booking.create');
    
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});


// --- PHẦN SỬA LỖI TRANG ĐÁNH GIÁ (REVIEWS) ---
// Thay vì trỏ vào MovieController::index (gây nhảy trang), 
// tôi trỏ nó tạm vào một hàm khác hoặc để nguyên nếu bạn muốn hiện danh sách phim ở đó.
// Tuy nhiên, nếu bạn muốn tách biệt, hãy đảm bảo View không gọi nhầm Route này.
Route::get('/reviews', [MovieController::class, 'index'])->name('reviews.index');