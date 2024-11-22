<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ilanlar = [
            [
                'name' => 'Örnek İlan 1',
                'description' => 'Bu bir örnek ilandır.',
                'fiyat' => 100,
                'kategori' => 'İş İlanları',
                'image' => 'resim1.jpg',
                'user_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Örnek İlan 2',
                'description' => 'Başka bir örnek ilan.',
                'fiyat' => 200,
                'kategori' => 'Ev Eşyaları',
                'image' => 'resim1.jpg',
                'user_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Örnek İlan 2',
                'description' => 'Başka bir örnek ilan.',
                'fiyat' => 200,
                'kategori' => 'Ev Eşyaları',
                'image' => 'resim1.jpg',
                'user_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Örnek İlan 2',
                'description' => 'Başka bir örnek ilan.',
                'fiyat' => 200,
                'kategori' => 'Teknolojik Alet',
                'image' => 'resim1.jpg',
                'user_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Örnek İlan 2',
                'description' => 'Başka bir örnek ilan.',
                'fiyat' => 200,
                'kategori' => 'Ev Eşyaları',
                'image' => 'resim1.jpg',
                'user_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Örnek İlan 2',
                'description' => 'Başka bir örnek ilan.',
                'fiyat' => 200,
                'kategori' => 'Ev Eşyaları',
                'image' => 'resim1.jpg',
                'user_id' => 2,
                'created_at' => Carbon::now(),
            ],
            // Diğer ilanlar...
        ];

        // Verileri tabloya ekleyin
        foreach ($ilanlar as $ilan) {
            DB::table('ilan')->insert($ilan);
        }
    }
}
