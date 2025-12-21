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
}
