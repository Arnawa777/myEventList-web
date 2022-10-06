<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
            'user_id' => '1',
            'event_id' => '1',
            'rating' => '5',
            'body' => 'Good Works',
        ]);

        Review::create([
            'user_id' => '2',
            'event_id' => '1',
            'rating' => '2',
            'body' => 'Nahh',
        ]);
        Review::create([
            'user_id' => '3',
            'event_id' => '1',
            'rating' => '1',
        ]);

        Review::create([
            'user_id' => '2',
            'event_id' => '2',
            'rating' => '5',
            'body' => 'Good Works',
        ]);

        Review::create([
            'user_id' => '2',
            'event_id' => '7',
            'rating' => '8',
            'body' => 'Bagus nih tiap sore di malioboro',
        ]);

        Review::create([
            'user_id' => '3',
            'event_id' => '7',
            'rating' => '7',
            'body' => 'Seru anklungnya enak didenger',
        ]);

        Review::create([
            'user_id' => '4',
            'event_id' => '7',
            'rating' => '9',
            // 'body' => '',
        ]);
        Review::create([
            'user_id' => '5',
            'event_id' => '7',
            'rating' => '7',
            // 'body' => '',
        ]);
        Review::create([
            'user_id' => '6',
            'event_id' => '7',
            'rating' => '8',
            // 'body' => '',
        ]);
    }
}
