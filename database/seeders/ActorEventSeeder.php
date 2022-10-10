<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActorEvent;

class ActorEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActorEvent::create([
            'event_id' => '2',
            'actor_id' => '1',
            'role' => 'Utama',
        ]);

        ActorEvent::create([
            'event_id' => '2',
            'actor_id' => '2',
            'role' => 'Utama',
        ]);
        ActorEvent::create([
            'event_id' => '2',
            'actor_id' => '3',
            'role' => 'Pembantu',
        ]);
        ActorEvent::create([
            'event_id' => '2',
            'actor_id' => '4',
            'role' => 'Pembantu',
        ]);
        ActorEvent::create([
            'event_id' => '2',
            'actor_id' => '5',
            'role' => 'Pembantu',
        ]);
        ActorEvent::create([
            'event_id' => '2',
            'actor_id' => '6',
            'role' => 'Pembantu',
        ]);
    }
}
