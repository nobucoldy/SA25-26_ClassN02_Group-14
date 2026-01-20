<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $reviews = Review::with('movie')->latest()->paginate(12);
        return view('review.index', compact('reviews'));
    }

    public function showing()
    {
        $movies = Movie::where('status', 'showing')->paginate(12);
        return view('movies.status', compact('movies'));
    }

    public function upcoming()
    {
        $movies = Movie::where('status', 'coming_soon')->get();
        return view('movies.upcoming', compact('movies')); 
    }

    public function show($id)
{
    $movie = Movie::findOrFail($id);

    // 7 ngày tới
    $dates = collect(range(0, 6))->map(fn($i) => Carbon::today()->addDays($i)->toDateString());

    // Lấy tất cả showtime của phim này trong 7 ngày tới, cùng theater và room
    $allShowtimes = Showtime::with('theater')
        ->where('movie_id', $movie->id)
        ->whereBetween('show_date', [Carbon::today(), Carbon::today()->addDays(6)])
        ->orderBy('show_date')
        ->orderBy('start_time')
        ->get();

    // Lấy danh sách rạp liên quan đến phim này
    $theaters = $allShowtimes->pluck('theater')->unique('id');

    // Phân loại showtimes theo ngày -> rồi theo rạp
    $showtimes = collect();

    foreach ($dates as $date) {
    $dailyShowtimes = $allShowtimes
        ->filter(fn($st) => $st->show_date->toDateString() === $date)
        ->groupBy(fn($st) => $st->theater->name);

    $showtimes[$date] = $dailyShowtimes;
}


    return view('movies.show', compact('movie', 'showtimes', 'theaters'));
}


}
