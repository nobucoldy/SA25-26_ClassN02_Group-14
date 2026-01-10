<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Review;

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
    $movies = \App\Models\Movie::where('status', 'coming_soon')->get();
    return view('movies.upcoming', compact('movies')); 
}
public function show($id)
{
    $movie = Movie::with('showtimes')->findOrFail($id);
    $showtimes = $movie->showtimes;

    return view('movies.show', compact('movie', 'showtimes'));
}
}
