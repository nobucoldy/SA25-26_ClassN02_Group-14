<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,      // users
            TheaterSeeder::class,         // theaters
            MoviesTableSeeder::class,     // movies
            RoomsTableSeeder::class,      // rooms
            SeatsTableSeeder::class,      // seats
            ScreeningTypeSeeder::class,
            ShowtimeSeeder::class,  // showtimes
            BookingSeeder::class,         // bookings + booking_seats
        ]);
    }
}
