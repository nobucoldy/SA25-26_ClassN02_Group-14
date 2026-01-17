<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    public function index(Request $request)
{
    // Lấy tất cả thành phố không trùng lặp để làm menu lọc
    $cities = Theater::select('city')->distinct()->pluck('city');
    
    // Bắt đầu truy vấn
    $query = Theater::query();

    // Nếu người dùng chọn thành phố, thì lọc theo thành phố đó
    if ($request->has('city') && $request->city != '') {
        $query->where('city', $request->city);
    }

    $theaters = $query->get();

    return view('theaters.index', compact('theaters', 'cities'));
}
   public function showSchedule(Request $request)
{
    // 1. Lấy danh sách các thành phố duy nhất (KHẮC PHỤC LỖI UNDEFINED VARIABLE $CITIES)
    $cities = \App\Models\Theater::select('city')->distinct()->pluck('city');

    // 2. Lấy danh sách rạp theo thành phố lọc
    $theaterQuery = \App\Models\Theater::query();
    if ($request->filled('city')) {
        $theaterQuery->where('city', $request->city);
    }
    $theaters = $theaterQuery->get();

    // 3. Lấy rạp đang được chọn (ưu tiên từ URL, nếu không lấy rạp đầu tiên)
    $selectedTheaterId = $request->get('theater_id', $theaters->first()->id ?? null);
    $selectedTheater = \App\Models\Theater::find($selectedTheaterId);

    // 4. Lấy lịch chiếu của rạp đó và gom nhóm theo phim
    $showtimesGroupedByMovie = collect(); // Mặc định là mảng rỗng
    if ($selectedTheater) {
        $showtimesGroupedByMovie = \App\Models\Showtime::where('theater_id', $selectedTheater->id)
            ->with('movie') // Eager loading để lấy info phim
            ->get()
            ->groupBy('movie_id');
    }

    // 5. TRUYỀN TẤT CẢ BIẾN SANG VIEW
    return view('theaters.index', compact(
        'theaters', 
        'cities', 
        'selectedTheater', 
        'showtimesGroupedByMovie', 
        'selectedTheaterId'
    ));
}
}