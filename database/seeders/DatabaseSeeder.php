<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            \Database\Seeders\UsersTableSeeder::class,
            \Database\Seeders\MoviesTableSeeder::class,
            \Database\Seeders\TheaterSeeder::class,
            \Database\Seeders\RoomsTableSeeder::class,
            \Database\Seeders\SeatsTableSeeder::class,
            \Database\Seeders\ShowtimesTableSeeder::class,
            \Database\Seeders\BookingSeeder::class,
        ]);
    }
}
