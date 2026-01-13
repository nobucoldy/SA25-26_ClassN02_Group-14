<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'movies'    => Movie::count(),
            'showtimes' => Showtime::count(),
            'bookings'  => Booking::count(),
            'users'     => User::count(),
        ]);
    }
}
