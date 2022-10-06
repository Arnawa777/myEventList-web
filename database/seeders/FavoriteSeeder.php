<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favorite::create([
            'user_id' => '1',
            'event_id' => '1',
        ]);

        Favorite::create([
            'user_id' => '1',
            'event_id' => '2',
        ]);
        Favorite::create([
            'user_id' => '1',
            'event_id' => '3',
        ]);
        Favorite::create([
            'user_id' => '1',
            'event_id' => '4',
        ]);
        Favorite::create([
            'user_id' => '2',
            'event_id' => '1',
        ]);
        Favorite::create([
            'user_id' => '3',
            'event_id' => '1',
        ]);
    }
}
