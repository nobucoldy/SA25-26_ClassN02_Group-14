<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CinemasTableSeeder extends Seeder
{
    public function run()
    {
        // 1. Tắt khóa ngoại để xóa sạch rạp cũ
        Schema::disableForeignKeyConstraints();
        DB::table('cinemas')->truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Chèn dữ liệu rạp (Đảm bảo ID 1 và 2 tồn tại cho bảng Rooms)
        DB::table('cinemas')->insert([
            [
                'id' => 1,
                'name' => 'BKL Cinema Hà Đông',
                'address' => '123 Main St, Hà Đông',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'BKL Cinema Cầu Giấy',
                'address' => '456 Broadway, Cầu Giấy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}