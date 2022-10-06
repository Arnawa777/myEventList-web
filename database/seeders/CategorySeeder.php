<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Drama',
            'slug' => 'drama'
        ]);

        Category::create([
            'name' => 'Musik',
            'slug' => 'musik'
        ]);

        Category::create([
            'name' => 'Tari',
            'slug' => 'tari'
        ]);

        Category::create([
            'name' => 'Wayang',
            'slug' => 'wayang'
        ]);
    }
}
