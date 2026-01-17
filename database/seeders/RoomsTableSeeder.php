<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        // Tắt khóa ngoại để xóa sạch bảng cũ
        Schema::disableForeignKeyConstraints();
        DB::table('rooms')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('rooms')->insert([
            [
                'id' => 1, 
                'theater_id' => 1, 
                'name' => 'Room 1', 
                'total_seats' => 100, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 2, 
                'theater_id' => 1, 
                'name' => 'Room 2', 
                'total_seats' => 100, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 3, 
                'theater_id' => 2, 
                'name' => 'Room 3', 
                'total_seats' => 100, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ]);
    }
}