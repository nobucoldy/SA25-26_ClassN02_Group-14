<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $showingMovies = Movie::where('status', 'showing')->get();

    // Phim sắp chiếu
        $upcomingMovies = Movie::where('status', 'coming_soon')->get();

        return view('home', compact('showingMovies', 'upcomingMovies'));
        }
}
