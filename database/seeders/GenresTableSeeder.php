<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            'Action', 'Comedy', 'Animation', 'Thriller', 
            'Adventure', 'Sci-Fi', 'Horror', 'Psychology', 
            'Family', 'Crime'
        ];

        foreach ($genres as $name) {
            Genre::create(['name' => $name]);
        }
    }
}
