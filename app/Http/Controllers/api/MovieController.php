<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        return response()->json($this->movieService->getAllMovies());
    }

    public function show($id)
    {
        return response()->json($this->movieService->getMovieById($id));
    }
}
