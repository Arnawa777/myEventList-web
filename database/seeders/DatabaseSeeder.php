<?php

namespace Database\Seeders;



use App\Models\Character;
use App\Models\Comment;
use App\Models\Event;
use App\Models\Favorite;
use App\Models\Person;
use App\Models\Post;
use App\Models\Review;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'username' => 'admin12',
            'email' => 'admin12@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123456'), // password
        ]);

        User::create([
            'username' => 'support12',
            'email' => 'support12@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123456'), // password
        ]);

        User::factory(20)->create();

        $this->call([
            CategorySeeder::class,
            TopicSeeder::class,
            LocationSeeder::class,
            PersonSeeder::class,
            CharacterSeeder::class,
            EventSeeder::class,
            PostSeeder::class,
            FavoriteSeeder::class,
            ReviewSeeder::class,
            CommentSeeder::class,
            WorkerSeeder::class,
            ActorSeeder::class,
            ActorEventSeeder::class,
        ]);

        Person::factory(5)->create();
        Character::factory(5)->create();
        Event::factory(10)->create();
        Post::factory(30)->create();
        // Favorite::factory(20)->create();
        Comment::factory(20)->create();
        // Review::factory(6)->create();
    }
}
