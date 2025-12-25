<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Booking;

class BookingController extends Controller
{
    public function create($showtimeId)
    {
        $showtime = Showtime::with('room.seats')->findOrFail($showtimeId);
        return view('booking.create', compact('showtime'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required',
            'seat_ids' => 'required|array|min:1',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'showtime_id' => $request->showtime_id,
            'total_amount' => count($request->seat_ids) * 50000,
            'status' => 'confirmed',
        ]);

        return redirect('/')->with('success', 'Booking thành công!');
    }
}
