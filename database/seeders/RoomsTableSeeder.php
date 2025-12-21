<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            ['cinema_id' => 1, 'name' => 'Room 1', 'total_seats' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['cinema_id' => 1, 'name' => 'Room 2', 'total_seats' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['cinema_id' => 2, 'name' => 'Room 1', 'total_seats' => 70, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
