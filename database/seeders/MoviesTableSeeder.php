<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies')->insert([
            [
                'title' => 'Avengers: Endgame',
                'description' => 'Superhero movie',
                'duration' => 181,
                'genre' => 'Action',
                'release_date' => '2019-04-26',
                'poster_url' => 'https://example.com/posters/avengers.jpg',
                'status' => 'showing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Inception',
                'description' => 'Sci-fi thriller',
                'duration' => 148,
                'genre' => 'Sci-Fi',
                'release_date' => '2010-07-16',
                'poster_url' => 'https://example.com/posters/inception.jpg',
                'status' => 'coming_soon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
