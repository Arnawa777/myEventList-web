<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
