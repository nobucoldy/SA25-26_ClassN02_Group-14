<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(12);
        return view('movies.status', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::with('showtimes')->findOrFail($id);
    
    // Lấy danh sách lịch chiếu ra một biến riêng để View sử dụng
    $showtimes = $movie->showtimes;

    // Truyền cả movie và showtimes sang View
    return view('movies.show', compact('movie', 'showtimes'));
    }
    public function upcoming()
{
    // 1. Lấy dữ liệu (Bạn đã làm đúng)
    $movies = \App\Models\Movie::where('status', 'upcoming')->get();
    
    // 2. PHẢI THÊM compact('movies') vào đây để truyền dữ liệu sang View
    return view('movies.upcoming', compact('movies')); 
}
}
