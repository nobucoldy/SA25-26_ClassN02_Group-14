<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê số lượng
        $movies    = Movie::count();
        $showtimes = Showtime::count();
        $bookings  = Booking::count();
        $users     = User::count();

        // 💰 REVENUE STATISTICS (only count confirmed bookings)
        $totalRevenue = Booking::where('status', 'confirmed')
            ->sum('total_amount');

        $todayRevenue = Booking::where('status', 'confirmed')
            ->whereDate('created_at', Carbon::today())
            ->sum('total_amount');

        $monthRevenue = Booking::where('status', 'confirmed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');

        return view('admin.dashboard', compact(
            'movies',
            'showtimes',
            'bookings',
            'users',
            'totalRevenue',
            'todayRevenue',
            'monthRevenue'
        ));
    }
}
