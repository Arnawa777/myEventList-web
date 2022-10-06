<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        // 5
        Location::create([
            'regency' => 'Sleman',
            'sub_regency' => 'Mlati'
        ]);

        Location::create([
            'regency' => 'Sleman',
            'sub_regency' => 'Prambanan'
        ]);

        Location::create([
            'regency' => 'Gunung Kidul',
            'sub_regency' => 'Semin'
        ]);
        // 8
        Location::create([
            'regency' => 'Gunung Kidul',
            'sub_regency' => 'Wonosari'
        ]);

        Location::create([
            'regency' => 'Yogyakarta',
            'sub_regency' => 'Gondomanan'
        ]);

        Location::create([
            'regency' => 'Yogyakarta',
            'sub_regency' => 'Kotagede'
        ]);

        Location::create([
            'regency' => 'Yogyakarta',
            'sub_regency' => 'Mergangsan'
        ]);
        // 12
        Location::create([
            'regency' => 'Yogyakarta',
            'sub_regency' => 'Umbulharjo'
        ]);
    }
}
