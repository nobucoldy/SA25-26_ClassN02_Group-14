<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShowtimesTableSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('showtimes')->truncate(); 
        Schema::enableForeignKeyConstraints();

        DB::table('showtimes')->insert([
            [
                'id' => 1,
                'movie_id' => 1, 
                'theater_id' => 1,
                'room_id' => 1,  
                'show_date' => '2026-01-06', // Đổi 'date' thành 'show_date'
                'start_time' => '09:30:00',
                'end_time' => '11:17:00',
                'price' => 50000,
                'created_at' => now(), 
                'updated_at' => now(),
                
            ],
            [
                'id' => 2,
                'movie_id' => 1,
                'theater_id' => 1,
                'room_id' => 1,
                'show_date' => '2026-01-06', // Đổi 'date' thành 'show_date'
                'start_time' => '12:45:00',
                'end_time' => '14:30:00',
                'price' => 50000,
                'created_at' => now(), 
                'updated_at' => now(),
            ]
        ]);
    }
}