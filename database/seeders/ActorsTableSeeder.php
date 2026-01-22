<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorsTableSeeder extends Seeder
{
    public function run()
    {
        $actors = [
            ['name' => 'Sam Worthington', 'birth_date' => '1976-08-02', 'photo_url' => 'actors/samworthington.jpg'],
            ['name' => 'Zoe Saldana', 'birth_date' => '1978-06-19', 'photo_url' => 'actors/zoesaldana.jpg'],
            ['name' => 'Idris Elba', 'birth_date' => '1972-09-06', 'photo_url' => 'actors/idriselba.jpg'],
            ['name' => 'Chris Pratt', 'birth_date' => '1979-06-21', 'photo_url' => 'actors/chrispratt.jpg'],
            ['name' => 'Emma Stone', 'birth_date' => '1988-11-06', 'photo_url' => 'actors/emmastone.jpg'],
            ['name' => 'Tom Holland', 'birth_date' => '1996-06-01', 'photo_url' => 'actors/tomholland.jpg'],
        ];

        foreach ($actors as $actor) {
            Actor::create($actor);
        }
    }
}
