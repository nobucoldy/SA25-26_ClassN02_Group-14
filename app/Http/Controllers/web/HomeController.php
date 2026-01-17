<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Phim đang chiếu & sắp chiếu
        $showingMovies = Movie::where('status', 'showing')->get();
        $upcomingMovies = Movie::where('status', 'coming_soon')->get();

        // --- Movie Schedule Data ---
        $cities = Theater::select('city')->distinct()->pluck('city');

        $theaters = Theater::when($request->filled('city'), fn($q) => $q->where('city', $request->city))->get();

        $selectedTheaterId = $request->get('theater_id', optional($theaters->first())->id);
        $selectedTheater = Theater::find($selectedTheaterId);

        $selectedDate = $request->get('show_date', now()->toDateString());

        $showtimesGroupedByMovie = collect();
        if ($selectedTheater) {
            $showtimesGroupedByMovie = Showtime::where('theater_id', $selectedTheater->id)
                ->where('show_date', $selectedDate)
                ->with('movie')
                ->get()
                ->groupBy('movie_id');
        }

        return view('home', compact(
            'showingMovies',
            'upcomingMovies',
            'cities',
            'theaters',
            'selectedTheater',
            'selectedTheaterId',
            'selectedDate',
            'showtimesGroupedByMovie'
        ));
    }
}
