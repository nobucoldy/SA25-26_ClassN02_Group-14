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
        // Lấy danh sách thành phố
        $cities = Theater::select('city')->distinct()->pluck('city');

        // Lọc rạp theo thành phố nếu có
        $theaters = Theater::when($request->filled('city'), function ($q) use ($request) {
            $q->where('city', $request->city);
        })->get();

        // Rạp được chọn
        $selectedTheaterId = $request->get('theater_id', optional($theaters->first())->id);
        $selectedTheater   = Theater::find($selectedTheaterId);

        // Ngày được chọn
        $selectedDate = $request->get('show_date', now()->toDateString());

        $showtimesGroupedByMovie = collect();

        if ($selectedTheater) {
            $showtimesGroupedByMovie = Showtime::with('movie')
                ->where('theater_id', $selectedTheater->id)
                ->whereDate('show_date', $selectedDate)
                ->orderBy('start_time')
                ->get()
                ->groupBy('movie_id');
        }

        return view('theaters.schedule', compact(
            'theaters',
            'cities',
            'selectedTheater',
            'selectedTheaterId',
            'selectedDate',
            'showtimesGroupedByMovie'
        ));
    }

}
