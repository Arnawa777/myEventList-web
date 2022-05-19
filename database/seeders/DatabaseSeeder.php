<?php

namespace Database\Seeders;


use App\Models\Actor;
use App\Models\Category;
use App\Models\Character;
use App\Models\Comment;
use App\Models\Event;
use App\Models\Favorite;
use App\Models\Person;
use App\Models\Post;
use App\Models\Review;
use App\Models\Topic;
use App\Models\User;
use App\Models\Worker;

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

        Actor::factory(10)->create();
        Character::factory(5)->create();
        Comment::factory(5)->create();
        Event::factory(10)->create();
        Favorite::factory(10)->create();
        Person::factory(5)->create();
        Post::factory(20)->create();
        Review::factory(5)->create();
        User::factory(5)->create();
        Worker::factory(5)->create();

        Category::create([
            'name' => 'Wayang',
            'slug' => 'wayang']);
            
        Category::create([
            'name' => 'Tari',
            'slug' => 'tari' ]);
            
        Category::create([
            'name' => 'Drama',
            'slug' => 'drama' ]);

        Topic::create([
            'name' => 'Event Recommendation',
            'slug' => 'event-rec'
        ]);
        
        Topic::create([
            'name' => 'Event Discussion',
            'slug' => 'event-dis'
        ]);
        Topic::create([
            'name' => 'News Discussion',
            'slug' => 'news-discussion'
        ]);
        
        
    }
}
