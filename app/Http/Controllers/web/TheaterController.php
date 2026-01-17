<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Theater;
use App\Models\Showtime;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    // DANH SÁCH RẠP
    public function index(Request $request)
    {
        $cities = Theater::select('city')->distinct()->pluck('city');

        $query = Theater::query();
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $theaters = $query->get();

        return view('theaters.index', compact('theaters', 'cities'));
    }

    // LỊCH CHIẾU
   public function showSchedule(Request $request)
{
    $cities = Theater::select('city')->distinct()->pluck('city');

    $theaters = Theater::when($request->filled('city'), function ($q) use ($request) {
        $q->where('city', $request->city);
    })->get();

    $selectedTheaterId = $request->get('theater_id', optional($theaters->first())->id);
    $selectedTheater = Theater::find($selectedTheaterId);

    // Lấy ngày được chọn (mặc định hôm nay)
    $selectedDate = $request->get('show_date', now()->toDateString());

    // Lấy showtimes theo rạp và ngày
    $showtimesGroupedByMovie = collect(); // mặc định rỗng
    if ($selectedTheater) {
        $showtimesGroupedByMovie = Showtime::where('theater_id', $selectedTheater->id)
            ->where('show_date', $selectedDate) // lọc theo cột show_date
            ->with('movie')
            ->get()
            ->groupBy('movie_id');
    }

    return view('theaters.schedule', compact(
        'theaters',
        'cities',
        'selectedTheater',
        'selectedTheaterId',
        'showtimesGroupedByMovie',
        'selectedDate' // gửi sang view
    ));
}

}
