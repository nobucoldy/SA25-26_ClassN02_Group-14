<?php
namespace App\Services;

use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function createBooking($user, $data)
    {
        return DB::transaction(function () use ($user, $data) {
            $booking = Booking::create([
                'user_id' => $user->id,
                'showtime_id' => $data['showtime_id'],
            ]);

            foreach ($data['seat_ids'] as $seatId) {
                $seat = Seat::findOrFail($seatId);
                $seat->update(['is_booked' => true]);
                $booking->seats()->attach($seatId);
            }

            return $booking->load('seats');
        });
    }

    public function cancelBooking($user, $id)
    {
        $booking = Booking::where('user_id', $user->id)->findOrFail($id);

        foreach ($booking->seats as $seat) {
            $seat->update(['is_booked' => false]);
        }

        $booking->delete();

        return ['message' => 'Booking canceled'];
    }

    public function getUserBookings($user)
    {
        return Booking::where('user_id', $user->id)->with('seats.showtime.movie')->get();
    }
}
