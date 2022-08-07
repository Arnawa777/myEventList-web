<?php

namespace Database\Seeders;


use App\Models\Category;
use App\Models\Character;
use App\Models\Comment;
use App\Models\Event;
use App\Models\Favorite;
use App\Models\Location;
use App\Models\Person;
use App\Models\Post;
use App\Models\Review;
use App\Models\Topic;
use App\Models\User;
use App\Models\Worker;
use App\Models\Actor;
use App\Models\ActorEvent;

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
        User::factory(5)->create();

        Category::create([
            'name' => 'Wayang',
            'slug' => 'wayang'
        ]);

        Category::create([
            'name' => 'Tari',
            'slug' => 'tari'
        ]);

        Category::create([
            'name' => 'Drama',
            'slug' => 'drama'
        ]);

        Topic::create([
            'topic' => 'MyEventList',
            'sub_topic' => 'Announcements',
            'slug' => 'announcements',
            'description' => 'Updates, changes, and additions to MyEventList.',
        ]);

        Topic::create([
            'topic' => 'MyEventList',
            'sub_topic' => 'Support',
            'slug' => 'support',
            'description' => 'Have a problem using the site or think you found a bug? Post here',
        ]);

        Topic::create([
            'topic' => 'MyEventList',
            'sub_topic' => 'Suggestions',
            'slug' => 'suggestions',
            'description' => 'Have an idea or suggestion for the site? Share it here.',
        ]);

        Topic::create([
            'topic' => 'Event',
            'sub_topic' => 'Event Schedules',
            'slug' => 'event-schedules',
            'description' => 'Share upcoming event.',
        ]);

        Topic::create([
            'topic' => 'Event',
            'sub_topic' => 'Event Recommendations',
            'slug' => 'event-recommendations',
            'description' => 'Ask the community for event recommendations or help other users looking for suggestions.',
        ]);

        Topic::create([
            'topic' => 'Event',
            'sub_topic' => 'Event Discussion',
            'slug' => 'event-discussion',
            'description' => 'General event discussion that is not specific to any particular event.',
        ]);

        Topic::create([
            'topic' => 'General',
            'sub_topic' => 'Introductions',
            'slug' => 'introductions',
            'description' => 'New to MyEventList? Introduce yourself here.',
        ]);

        Topic::create([
            'topic' => 'General',
            'sub_topic' => 'Casual Discussion',
            'slug' => 'casual-discussion',
            'description' => 'General interest topics',
        ]);


        Location::create([
            'regency' => 'Kulon Progo',
            'sub_regency' => 'Sentolo'
        ]);

        Location::create([
            'regency' => 'Kulon Progo',
            'sub_regency' => 'Wates'
        ]);

        Location::create([
            'regency' => 'Bantul',
            'sub_regency' => 'Kasihan'
        ]);

        Location::create([
            'regency' => 'Sleman',
            'sub_regency' => 'Godean'
        ]);


        Person::factory(5)->create();
        Character::factory(5)->create();
        Event::factory(10)->create();


        Post::factory(20)->create();
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

        Comment::factory(5)->create();

        Worker::create([
            'event_id' => '1',
            'person_id' => '1',
            'role' => 'staff'
        ]);

        Worker::create([
            'event_id' => '1',
            'person_id' => '2',
            'role' => 'Manager'
        ]);

        Worker::create([
            'event_id' => '1',
            'person_id' => '3',
            'role' => 'Producer'
        ]);

        Worker::create([
            'event_id' => '2',
            'person_id' => '4',
            'role' => 'Kang Sapu'
        ]);

        Worker::create([
            'event_id' => '2',
            'person_id' => '2',
            'role' => 'Manager'
        ]);

        Worker::create([
            'event_id' => '2',
            'person_id' => '1',
            'role' => 'Manager'
        ]);

        Actor::create([
            'person_id' => '1',
            'character_id' => '1',
        ]);

        Actor::create([
            'person_id' => '1',
            'character_id' => '2',
        ]);

        Actor::create([
            'person_id' => '1',
            'character_id' => '3',
        ]);

        ActorEvent::create([
            'event_id' => '1',
            'actor_id' => '1',
        ]);

        ActorEvent::create([
            'event_id' => '1',
            'actor_id' => '2',
        ]);
    }
}
