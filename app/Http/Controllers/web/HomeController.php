<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->limit(6)->get();
        return view('home', compact('movies'));
    }
}
