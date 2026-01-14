<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
   public function index(Request $request)
{
    $query = Showtime::with(['movie', 'room']);

    if ($request->movie) {
        $query->whereHas('movie', function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->movie . '%');
        });
    }

    if ($request->date) {
        $query->where('show_date', $request->date);
    }

    $showtimes = $query->orderBy('show_date')
                       ->orderBy('start_time')
                       ->paginate(10);

    return view('admin.showtimes.index', compact('showtimes'));
}
}
