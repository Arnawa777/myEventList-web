<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Character;
use App\Models\Person;
use App\Models\Post;
use App\Models\Role;
use App\Models\Topic;

use Illuminate\Database\Seeder;

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

        Character::factory(5)->create();
        Comment::factory(5)->create();
        Event::factory(10)->create();
        Person::factory(5)->create();
        Post::factory(20)->create();
        User::factory(5)->create();

        Category::create([
            'name' => 'Wayang',
            'slug' => 'wayang']);
            
        Category::create([
            'name' => 'Tari',
            'slug' => 'tari' ]);
            
        Category::create([
            'name' => 'Drama',
            'slug' => 'drama' ]);

        Role::create([
            'name' => 'Actor',
            'slug' => 'actor',
            'detailed' => 'Main'
        ]);
        Role::create([
            'name' => 'Staff',
            'slug' => 'staff',
            'detailed' => 'Director'
        ]);
        Role::create([
            'name' => 'Actor',
            'slug' => 'actor',
            'detailed' => 'support'
        ]);

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
