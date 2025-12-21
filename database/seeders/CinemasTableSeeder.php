<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CinemasTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cinemas')->insert([
            [
                'name' => 'Galaxy Cinema',
                'address' => '123 Main St',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MegaStar Cinema',
                'address' => '456 Broadway',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
