<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Director;

class DirectorsTableSeeder extends Seeder
{
    public function run()
    {
        $directors = [
            ['name' => 'James Cameron', 'birth_date' => '1954-08-16', 'photo_url' => 'directors/jamescameron.jpg'],
            ['name' => 'Byron Howard', 'birth_date' => '1968-12-26', 'photo_url' => 'directors/byronhoward.jpg'],
            ['name' => 'Jennifer Lee', 'birth_date' => '1971-03-22', 'photo_url' => 'directors/jenniferlee.jpg'],
            ['name' => 'Christopher Nolan', 'birth_date' => '1970-07-30', 'photo_url' => 'directors/nolan.jpg'],
            ['name' => 'Taika Waititi', 'birth_date' => '1975-08-16', 'photo_url' => 'directors/taikawaititi.jpg'],
        ];

        foreach ($directors as $director) {
            Director::create($director);
        }
    }
}
