<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showtime;

class ShowtimeController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with(['movie', 'room'])->get();

        return view('admin.showtimes.index', compact('showtimes'));
    }
}
