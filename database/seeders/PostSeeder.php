<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id' => '1',
            'topic_id' => '1',
            'title' => 'MyEventList Rilis',
            'slug' => 'myeventlist-rilis',
            'body' => "Berikut telah rilis website MyEventList 1.0 Selamat mencoba!!",
        ]);

        Post::create([
            'user_id' => '2',
            'topic_id' => '3',
            'title' => 'Event hanya di jogja',
            'slug' => 'event-hanya-di-jogja',
            'body' => "Event terlalu sedikit tolong tambahin lagi diluar jogja!!",
        ]);

        Post::create([
            'user_id' => '1',
            'topic_id' => '7',
            'title' => 'Perkenalan admin',
            'slug' => 'perkenalan-admin',
            'body' => "Hallo disini admin pertama 
            feel free to give us a suggestions",
        ]);
    }
}
