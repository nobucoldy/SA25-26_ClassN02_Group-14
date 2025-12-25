<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Showtime;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'exists:seats,id',
        ]);

        $user = $request->user();
        $showtime = Showtime::with('room')->findOrFail($request->showtime_id);

        // 1️⃣ Kiểm tra ghế có thuộc phòng không
        $validSeatCount = Seat::where('room_id', $showtime->room_id)
            ->whereIn('id', $request->seat_ids)
            ->count();

        if ($validSeatCount !== count($request->seat_ids)) {
            return response()->json([
                'message' => 'Some seats do not belong to this room'
            ], 422);
        }

        // 2️⃣ Kiểm tra ghế đã bị booking chưa
        $bookedSeats = DB::table('booking_seats')
            ->join('bookings', 'booking_seats.booking_id', '=', 'bookings.id')
            ->where('bookings.showtime_id', $showtime->id)
            ->whereIn('booking_seats.seat_id', $request->seat_ids)
            ->pluck('booking_seats.seat_id');

        if ($bookedSeats->isNotEmpty()) {
            return response()->json([
                'message' => 'Some seats already booked',
                'booked_seats' => $bookedSeats
            ], 409);
        }

        // 3️⃣ Tạo booking (transaction để an toàn)
        return DB::transaction(function () use ($user, $showtime, $request) {

            $totalAmount = count($request->seat_ids) * $showtime->price;

            $booking = Booking::create([
                'user_id' => $user->id,
                'showtime_id' => $showtime->id,
                'total_amount' => $totalAmount,
                'status' => 'confirmed',
            ]);

            foreach ($request->seat_ids as $seatId) {
                $booking->seats()->attach($seatId);
            }

            return response()->json([
                'message' => 'Booking created successfully',
                'booking' => $booking->load([
                    'seats',
                    'showtime.movie',
                    'showtime.room'
                ])

            ], 201);
        });
    }
}
