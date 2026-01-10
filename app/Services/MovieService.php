<?php
namespace App\Services;

use App\Models\Movie;

class MovieService
{
    public function getAllMovies()
    {
        return Movie::all();
    }

    public function getMovieById($id)
    {
        return Movie::findOrFail($id);
    }

    public function getShowingMovies()
    {
        return Movie::where('status', 'showing')->get();
    }

    public function getComingSoonMovies()
    {
        return Movie::where('status', 'coming_soon')->get();
    }
}
