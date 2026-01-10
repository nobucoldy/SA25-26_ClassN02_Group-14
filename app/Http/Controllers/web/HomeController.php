<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $showingMovies = Movie::where('status', 'showing')->get();

        return view('home', compact('showingMovies'));
    }
}
