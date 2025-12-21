<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShowtimesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('showtimes')->insert([
            [
                'movie_id' => 1,
                'room_id' => 1,
                'show_date' => '2025-12-25',
                'start_time' => '18:00:00',
                'end_time' => '21:00:00',
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
