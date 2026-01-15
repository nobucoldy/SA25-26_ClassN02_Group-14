<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'duration', 'genre',
        'release_date', 'poster_url', 'status'
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
    
}
