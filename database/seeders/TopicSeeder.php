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
            'topic' => 'SanggarJogja',
            'sub_topic' => 'Pengumuman',
            'slug' => 'pengumuman',
            'description' => 'Pembaruan, perubahan, dan penambahan pada Website..',
        ]);

        Topic::create([
            'topic' => 'SanggarJogja',
            'sub_topic' => 'Dukungan',
            'slug' => 'dukungan',
            'description' => 'Punya masalah saat menggunakan situs atau merasa menemukan bug? Post di sini',
        ]);

        Topic::create([
            'topic' => 'SanggarJogja',
            'sub_topic' => 'Saran',
            'slug' => 'saran',
            'description' => 'Punya ide atau saran untuk situs ini? Bagikan di sini.',
        ]);

        Topic::create([
            'topic' => 'Komunitas',
            'sub_topic' => 'Jadwal Komunitas',
            'slug' => 'jadwal-komunitas',
            'description' => 'Bagikan Jadwal Pertunjukkan Komunitas yang akan datang.',
        ]);

        //5
        Topic::create([
            'topic' => 'Komunitas',
            'sub_topic' => 'Rekomendasi Komunitas',
            'slug' => 'rekomendasi-komunitas',
            'description' => 'Mintalah rekomendasi Komunitas dari sini atau bantu pengguna lain mencari saran.',
        ]);

        Topic::create([
            'topic' => 'Komunitas',
            'sub_topic' => 'Diskusi Komunitas',
            'slug' => 'diskusi-komunitas',
            'description' => 'Diskusi Umum yang tidak khusus untuk Komunitas Sanggar tertentu.',
        ]);

        Topic::create([
            'topic' => 'Umum',
            'sub_topic' => 'Perkenalan',
            'slug' => 'perkenalan',
            'description' => 'Baru di Forum ini? Perkenalkan diri Anda di sini.',
        ]);

        //8
        Topic::create([
            'topic' => 'Umum',
            'sub_topic' => 'Diskusi Santai',
            'slug' => 'diskusi-santai',
            'description' => 'Diskusi santai secara umum',
        ]);
    }
}
