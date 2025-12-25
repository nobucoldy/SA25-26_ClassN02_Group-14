<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(12);
        return view('movies.index', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::with('showtimes')->findOrFail($id);
        return view('movies.show', compact('movie'));
    }
}
