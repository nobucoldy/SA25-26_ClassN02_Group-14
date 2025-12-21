<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $service;

    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_ids' => 'required|array',
        ]);

        return response()->json($this->service->createBooking($request->user(), $data));
    }

    public function cancel($id, Request $request)
    {
        return response()->json($this->service->cancelBooking($request->user(), $id));
    }

    public function myBookings(Request $request)
    {
        return response()->json($this->service->getUserBookings($request->user()));
    }
}
