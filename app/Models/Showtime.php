<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id', 
        'theater_id', // BẮT BUỘC THÊM DÒNG NÀY
        'room_id',
        'show_date', 
        'start_time', 
        'end_time', 
        'price'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function theater()
    {
        // Quan hệ kết nối đến rạp
        return $this->belongsTo(Theater::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}