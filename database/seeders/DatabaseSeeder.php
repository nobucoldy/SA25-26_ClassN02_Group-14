<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TheaterSeeder;
use Database\Seeders\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,      // users
            TheaterSeeder::class,         // theaters
            GenresTableSeeder::class,     // genres
            DirectorsTableSeeder::class,  // directors
            ActorsTableSeeder::class,     // actors
            MoviesTableSeeder::class,     // movies
            RoomsTableSeeder::class,      // rooms
            SeatsTableSeeder::class,      // seats
            ScreeningTypeSeeder::class,
            ShowtimeSeeder::class,  // showtimes
            BookingSeeder::class,         // bookings + booking_seats
        ]);
    }
}
