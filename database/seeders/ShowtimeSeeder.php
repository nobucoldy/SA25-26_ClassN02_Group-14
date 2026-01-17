<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use App\Models\Theater;
use Carbon\Carbon;

class ShowtimeSeeder extends Seeder
{
    public function run()
    {
        $movies = Movie::all();
        $theaters = Theater::all();
        $timeSlots = ['10:00', '13:00', '16:00', '19:00', '21:30'];

        foreach ($theaters as $theater) {
            $rooms = $theater->rooms;
            if ($rooms->isEmpty()) continue;

            foreach ($movies as $movie) {
                // Lặp 7 ngày riêng biệt
                for ($i = 0; $i < 7; $i++) {
                    $showDate = Carbon::today()->addDays($i);

                    $slots = collect($timeSlots)->shuffle()->take(rand(3,5));

                    foreach ($slots as $slot) {
                        $room = $rooms->random();

                        DB::table('showtimes')->insert([
                            'movie_id'   => $movie->id,
                            'theater_id' => $theater->id,
                            'room_id'    => $room->id,
                            'show_date'  => $showDate->toDateString(),      // chỉ lấy ngày
                            'start_time' => Carbon::parse($slot)->format('H:i:s'), // chỉ giờ
                            'end_time'   => Carbon::parse($slot)->addHours(2)->format('H:i:s'), // giả sử phim 2h
                            'price'      => rand(70000, 150000),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        $this->command->info('Showtimes seeded for 7 separate days!');
    }
}
