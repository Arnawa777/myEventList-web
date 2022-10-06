<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Worker;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Worker::create([
            'event_id' => '4',
            'person_id' => '2',
            'role' => 'Ketua'
        ]);

        Worker::create([
            'event_id' => '7',
            'person_id' => '3',
            'role' => 'Ketua'
        ]);

        Worker::create([
            'event_id' => '7',
            'person_id' => '4',
            'role' => 'Anggota'
        ]);

        Worker::create([
            'event_id' => '7',
            'person_id' => '5',
            'role' => 'Anggota'
        ]);

        Worker::create([
            'event_id' => '7',
            'person_id' => '6',
            'role' => 'Anggota'
        ]);

        Worker::create([
            'event_id' => '7',
            'person_id' => '7',
            'role' => 'Anggota'
        ]);

        Worker::create([
            'event_id' => '7',
            'person_id' => '8',
            'role' => 'Anggota'
        ]);

        Worker::create([
            'event_id' => '8',
            'person_id' => '10',
            'role' => 'Penyanyi'
        ]);

        Worker::create([
            'event_id' => '8',
            'person_id' => '11',
            'role' => 'Penyanyi'
        ]);
    }
}
