<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Character;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Character::create([
            'name' => 'Bagong',
            'slug' => 'bagong',
            'description' => "Ki Lurah bagong atau akrab dipanggil Bagong merupakan salah satu tokoh Punakawan yang paling muda seusai kisah pewayangan jawa. Di mana bagong merupakan anak angkat Semar yang paling bungsu",
            'picture' => 'bagong.jpg',
        ]);

        Character::create([
            'name' => 'Gareng',
            'slug' => 'gareng',
            'description' => "Gareng adalah punakawan yang berkaki pincang. Hal ini merupakan sebuah sanepa dari sifat Gareng sebagai kawula yang selalu hati-hati dalam bertindak. Selain itu, cacat fisik Gareng yang lain adalah tangan yang ciker atau patah. Ini adalah sanepa bahwa Gareng memiliki sifat tidak suka mengambil hak milik orang lain. Diceritakan bahwa tumit kanannya terkena semacam penyakit bubul.",
            'picture' => 'gareng.png',
        ]);

        Character::create([
            'name' => 'Petruk',
            'slug' => 'petruk',
            'description' => "ia adalah anak Raja Gandarwa raksasa di pertapaan dan bertempat di dalam laut bernama Begawan Salantara. Sebelumnya ia bernama Bambang Pecruk Panyukilan. Ia gemar bersenda gurau, baik dengan ucapan maupun tingkah laku dan senang berkelahi. Ia seorang yang pilih tanding/sakti di tempat kediamannya dan daerah sekitarnya",
            'picture' => 'petruk.jpg',
        ]);

        Character::create([
            'name' => 'Semar',
            'slug' => 'semar',
            'description' => "Semar (ꦱꦼꦩꦂ) atau Batara Ismaya Batara Iswara Jurudyah Punta Prasanta Semar (ꦨꦛꦫ​ꦆꦱ꧀ꦩꦪ​ꦨꦛꦫ​ꦆꦱ꧀ꦮꦫ​ꦙꦸꦫꦸꦢꦾꦃ​ꦦꦸꦤ꧀ꦠ​ꦦꦿꦱꦤ꧀ꦠ​ꦯꦺꦩꦂ) adalah nama tokoh utama dalam punakawan di pewayangan Jawa. Tokoh ini dikisahkan sebagai pengasuh sekaligus penasihat para kesatria dalam pementasan wiracarita Mahabharata dan Ramayana. Meski demikian, nama Semar tidak ditemukan dalam naskah asli kedua wiracarita tersebut (berbahasa Sanskerta), karena tokoh ini merupakan ciptaan tulen pujangga Jawa.",
            'picture' => 'Semar.jpg',
        ]);

        Character::create([
            'name' => 'Gatot Kaca',
            'slug' => 'gatot-kaca',
            "description" => "dalam pewayangan Jawa, ia dikenal dengan sebutan Gatotkoco (bahasa Jawa: Gathotkaca). Kesaktiannya dikisahkan luar biasa, antara lain mampu terbang di angkasa tanpa menggunakan sayap, serta terkenal dengan julukan otot kawat tulang besi.",
            'picture' => 'Gatotkaca.jpg',
        ]);

        Character::create([
            'name' => 'Boma Narakasura',
            'slug' => 'boma-narakasura',
            'description' => "Tokoh Naraka juga dikenal dalam pewayangan Jawa sebagai Boma Narakasura, yaitu putra Batara Wisnu dengan Batari Pertiwi. Ia dilahirkan di Kahyangan Ekapratala tempat tinggal Batara Ekawarna, kakeknya dari pihak ibu",
            'picture' => 'Prabu-Boma-Narakasura.jpeg',
        ]);

        //Goa Kiskendo 7
        Character::create([
            'name' => 'Maheso Suro',
            'slug' => 'maheso-suro',
        ]);
        Character::create([
            'name' => 'Dewi Toro',
            'slug' => 'dewi-toro',
        ]);
        Character::create([
            'name' => 'Lembu Suro',
            'slug' => 'lembu-suro',
        ]);

        Character::create([
            'name' => 'Batara Guru',
            'slug' => 'batara-guru',
            'description' => "Menurut mitologi Jawa, Bathara Guru merupakan Dewa yang merajai ketiga dunia, yakni Mayapada (dunia para dewa atau surga), Madyapada (dunia manusia atau bumi), Arcapada (dunia bawah atau neraka). Ia merupakan perwujudan dari dewa Siwa yang mengatur wahyu, hadiah, dan berbagai ilmu. Batara Guru mempunyai sakti (istri) bernama Dewi Uma dan Dewi Umaranti. ",
            'picture' => 'Batara-Guru.jpg',
        ]);

        Character::create([
            'name' => 'Subali',
            'slug' => 'subali',
            'description' => "Seorang raja Wanara dalam wiracarita Ramayana. Ia merupakan kakak dari Sugriwa, sekutu Sri Rama.",
            'picture' => 'Subali.jpg',
        ]);
        //12
        Character::create([
            'name' => 'Sugriwa',
            'slug' => 'sugriwa',
            'description' => " Ia adalah seorang raja kera dan merupakan seekor wanara. Ia tinggal di Kerajaan Kiskenda bersama kakaknya yang bernama Subali. Ia adalah teman Sri Rama dan membantunya memerangi Rahwana untuk menyelamatkan Sita.",
            'picture' => 'Sugriwa.jpg',
        ]);
    }
}
