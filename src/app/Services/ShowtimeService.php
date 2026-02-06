<?php
namespace App\Services;

use App\Models\Showtime;

class ShowtimeService
{
    public function getAllShowtimes()
    {
        return Showtime::all();
    }

    public function getShowtimeById($id)
    {
        return Showtime::findOrFail($id);
    }

    public function getAvailableSeats($id)
    {
        $showtime = Showtime::findOrFail($id);
        return $showtime->seats()->where('is_booked', false)->get();
    }
}
