<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsTableSeeder extends Seeder
{
    public function run()
    {
        $roomId = 1;
        $rows = range('A', 'H'); // 8 hàng
        $cols = range(1, 10);    // 10 cột

        // 8 hàng đầu: 8 hàng thường
        foreach ($rows as $index => $row) {
            $type = 'normal'; // 8 hàng đầu là normal
            foreach ($cols as $col) {
                DB::table('seats')->insert([
                    'room_id' => $roomId,
                    'seat_code' => $row . sprintf('%02d', $col),
                    'seat_type' => $type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Hàng cuối: 5 ghế dài (couple)
        $lastRow = 'I';
        for ($i = 1; $i <= 5; $i++) {
            DB::table('seats')->insert([
                'room_id' => $roomId,
                'seat_code' => $lastRow . sprintf('%02d', $i),
                'seat_type' => 'couple',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
