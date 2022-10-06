<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dalang
        Person::create([
            'name' => 'Rendy Ratnanto Adhi Putra',
            'slug' => 'rendy-ratnanto-adhi-putra',
            'picture' => 'Ki-Rendy.jpg'
        ]);

        Person::create([
            'name' => 'Gita Gilang',
            'slug' => 'gita-gilang',
            'picture' => 'Gita Gilang.jpg'
        ]);

        Person::create([
            'name' => 'Sekti Setyadi',
            'slug' => 'sekti-setyadi',
            // 'picture' => ''
        ]);

        //4
        Person::create([
            'name' => 'Budi Sampoerna',
            'slug' => 'budi-sampoerna',
            'picture' => 'budisampoernaa.jpg'
        ]);

        Person::create([
            'name' => 'Faqih Anom Prastyo',
            'slug' => 'faqih-anom-prastyo',
            'picture' => 'faqih-anom-prastyo.jpg'
        ]);

        Person::create([
            'name' => 'Indra',
            'slug' => 'indra',
            'picture' => 'Indra.jpg'
        ]);

        Person::create([
            'name' => 'Ponco Prastyo',
            'slug' => 'ponco-prastyo',
            'picture' => 'ponco-prastyo.jpg'
        ]);

        Person::create([
            'name' => 'Sigit Prayoga',
            'slug' => 'sigit-prayoga',
            'picture' => 'Sigit Prayoga.jpg'
        ]);

        //9
        Person::create([
            'name' => 'Nurma Mitzuhu Nurika',
            'slug' => 'nurma-mitzuhu-nurika',
            'picture' => 'nurma-mitzuhu-nurika.jpg'
        ]);

        Person::create([
            'name' => 'Tetek',
            'slug' => 'tetek',
            'picture' => 'Mas TETEK.jpg'
        ]);

        Person::create([
            'name' => 'Tata',
            'slug' => 'tata',
            'picture' => 'Mbak TATA.jpg'
        ]);

        // Timbul widodo unknown 12
        Person::create([
            'name' => 'Timbul Widodo Penari A',
            'slug' => 'timbul-widodo-penari-a',
        ]);

        Person::create([
            'name' => 'Timbul Widodo Penari B',
            'slug' => 'timbul-widodo-penari-b',
        ]);

        Person::create([
            'name' => 'Timbul Widodo Penari C',
            'slug' => 'timbul-widodo-penari-c',
        ]);

        Person::create([
            'name' => 'Timbul Widodo Penari D',
            'slug' => 'timbul-widodo-penari-d',
        ]);
        Person::create([
            'name' => 'Timbul Widodo Penari E',
            'slug' => 'timbul-widodo-penari-e',
        ]);
        Person::create([
            'name' => 'Timbul Widodo Penari F',
            'slug' => 'timbul-widodo-penari-f',
        ]);
    }
}
