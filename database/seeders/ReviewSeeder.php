<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Review::create([
    'movie_id' => 1,
    'user_id' => 1,
    'title' => 'Đánh giá thử',
    'content' => 'Phim rất hay, nên xem!',
    'rating' => 9.0,
]);

    }
}
