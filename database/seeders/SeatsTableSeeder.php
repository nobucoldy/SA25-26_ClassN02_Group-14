<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsTableSeeder extends Seeder
{
    public function run()
    {
        // Tạo 10 ghế mẫu cho Room 1
        for ($i = 1; $i <= 10; $i++) {
            DB::table('seats')->insert([
                'room_id' => 1,
                'seat_code' => 'A'.$i,
                'seat_type' => ($i <= 2) ? 'vip' : 'normal',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
