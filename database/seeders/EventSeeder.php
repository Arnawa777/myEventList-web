<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'name' => 'Jathilan Tunjung Putih',
            'slug' => 'jathilan-tunjung-putih',
            'location_id' => '1',
            'category_id' => '3',
            'description' => "Paguyuban Kesenian Jathilan
            Nyawiji Ing Seni, Nguri uri Kabudayan Jawi",
            'phone' => '089687632854',
            // 'date' => '',
            'picture' => 'tunjung-putih.jpg',
            'video' => 'Ww2GgjQycFk',
        ]);

        Event::create([
            'name' => 'Reog Timbul Widodo - Goa Kiskendo',
            'slug' => 'reog-timbul-widodo-goa-kiskendo',
            'location_id' => '1',
            'category_id' => '3',
            'description' => "Cerita ini di awali dari ambisi Raja Goa Kiskendo Prabu Maheso Suro yang ingin memperistri Dewi Toro ( Bidadari Kayangan) kemudian mengutus Patih Lembu Suro adiknya) melamar ke Kayangan, tetapi lamaran di tolak oleh Batara Guru ( Dewa Siwa).Patih Lembu Suro kemudian kembali ke Kraton Goa Kiskendo, menyampaikan kalau lamarannya di tolak.
            Mendengar itu Prabu Maheso Suro marah besar dan menyerang Kayangan, para dewa tidak mampu menandingi kesaktian Prabu Maheso Suro dan Patih Lembu Suro, dan akhirnya Bidadari Dewi Toro berhasil di bawa ke Kerajaan Goa Kiskendo.
            Kemudian para Dewa minta bantuan Subali dan Sugriwa untuk menyelamatkan Dewi Toro, dan menyatakan “bagi siapa yang bisa menolong Dewi Toro di kasih hadiah bakal dinikahkan dengan Dewi Toro.",
            // 'phone' => '',
            // 'date' => '',
            'picture' => 'timbul-widodo.jpg',
            'video' => '9ozQ_Dw8CiE',
        ]);

        Event::create([
            'name' => 'Sanggar Langit Alang-alang',
            'slug' => 'sanggar-langit-alang-alang',
            'location_id' => '2',
            'category_id' => '3',
            // 'description' => '',
            'phone' => '081915553827',
            // 'date' => '',
            // 'picture' => '',
            'video' => 'DEUtNmva9Lk',
        ]);

        //4
        Event::create([
            'name' => 'Sanggar Seni Gita Gilang',
            'slug' => 'sanggar-seni-gita-gilang',
            'location_id' => '5',
            'category_id' => '3',
            // 'description' => '',
            'phone' => '081804295053',
            // 'date' => '',
            'picture' => 'sanggar-gita-gilang.jpg',
            'video' => '5NiVKpQ0lYM',
        ]);

        // 5
        Event::create([
            'name' => 'Sendratari Ramayana Prambanan',
            'slug' => 'sendratari-ramayana-prambanan',
            'location_id' => '6',
            'category_id' => '3',
            'description' => "Sendratari Ramayana Prambanan merupakan sebuah pertunjukan yang menggabungkan tari dan drama tanpa dialog, diangkat dari cerita Ramayana dan dipertunjukkan di dekat Candi Prambanan di Pulau Jawa, Indonesia. Sendratari Ramayana Prambanan merupakan sendratari yang paling rutin mementaskan Sendratari Ramayana sejak 1961.",
            'phone' => '+628112640967',
            'date' => Carbon::parse('1961-07-26'),
            'picture' => 'sendratari-ramayana.jpg',
            'video' => '_McmW-fqa_E',
        ]);

        Event::create([
            'name' => 'Sanggar Seni RNB',
            'slug' => 'sanggar-seni-rnb',
            'location_id' => '8',
            'category_id' => '3',
            'description' => "Pusat Pembelajaran dan Pelatihan Berbagai Macam Seni (Seni Tari Kreasi, Tari Tradisional, Tari Kontemporer, Modern Dance, Seni Rupa, Akting, Teater, dll)",
            'phone' => '081995684165',
            // 'date' => '',
            'picture' => 'rnb.jpg',
            'video' => 'qOYzYl-zMKs',
        ]);

        //7
        Event::create([
            'name' => 'Angklung Carehal',
            'slug' => 'angklung-carehal',
            'location_id' => '9',
            'category_id' => '2',
            'description' => "Angklung Carehal nama Carehal sendiri memiliki arti Cari Rejeki Halal.

            Dari nama Carehal bisa diartikan sebagai apa yang mereka lakukan adalah hal yang positif dan bisa mendapatkan rejeki yang halal dengan membawakan lagu dari alat musik tradisional yang mereka mainkan.
            
            Angklung Carehal menjadi daya tarik tersendiri bagi wisatawan Malioboro. Angklung Carehal akan meramaikan suasana Malioboro mulai dari jam 4 sore hingga jam 9 malam.",
            'phone' => '+6281931777177',
            'date' => Carbon::parse('2013-12-23'),
            'picture' => 'angklung-carehal.jpg',
            'video' => 'cLAn16CygyE',
        ]);

        // 8
        Event::create([
            'name' => 'Bekso Mudho Laras',
            'slug' => 'bekso-mudho-laras',
            'location_id' => '12',
            'category_id' => '3',
            'description' => "Organisasi budaya Bekso Mudho Laras mempunyai tujuan melestarikan seni budaya dan mengembangkan kesenian jathilan yang ada. Untuk mencapai tujuan organisasi, Bekso Mudho Laras menyelenggarakan usaha-usaha yang terkait dengan kebudayaan tradisi, baik berupa seni pertunjukan, khususnya jathilan. Bekso Mudho Laras berfungsi untuk kegiatan pelatihan seni musik tradisional dan seni tari. ",
            'phone' => '087705365024',
            'date' => Carbon::parse('2019-04-06'),
            'picture' => 'bekso-mudho-laras.jpg',
            'video' => 'ewh8W3lj7Es',
        ]);
    }
}
