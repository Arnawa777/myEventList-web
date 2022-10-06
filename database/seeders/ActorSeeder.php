<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create([
            'person_id' => '12',
            'character_id' => '7',
        ]);

        Actor::create([
            'person_id' => '13',
            'character_id' => '8',
        ]);

        Actor::create([
            'person_id' => '14',
            'character_id' => '9',
        ]);

        Actor::create([
            'person_id' => '15',
            'character_id' => '10',
        ]);

        Actor::create([
            'person_id' => '16',
            'character_id' => '11',
        ]);

        Actor::create([
            'person_id' => '17',
            'character_id' => '12',
        ]);
    }
}
