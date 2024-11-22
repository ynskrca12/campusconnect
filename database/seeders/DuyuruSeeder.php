<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DuyuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $duyurular = [
            [
                'name' => 'Örnek Duyuru 1',
                'description' => 'Bu bir örnek duyuru açıklamasıdır.',
                'image' => 'resim1.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'Örnek Duyuru 2',
                'description' => 'Başka bir örnek duyuru açıklaması.',
                'image' => 'resim1.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'Örnek Duyuru 1',
                'description' => 'Bu bir örnek duyuru açıklamasıdır.',
                'image' => 'resim1.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'Örnek Duyuru 1',
                'description' => 'Bu bir örnek duyuru açıklamasıdır.',
                'image' => 'resim1.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'Örnek Duyuru 1',
                'description' => 'Bu bir örnek duyuru açıklamasıdır.',
                'image' => 'resim1.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'Örnek Duyuru 1',
                'description' => 'Bu bir örnek duyuru açıklamasıdır.',
                'image' => 'resim1.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'Örnek Duyuru 1',
                'description' => 'Bu bir örnek duyuru açıklamasıdır.',
                'image' => 'resim1.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'Örnek Duyuru 1',
                'description' => 'Bu bir örnek duyuru açıklamasıdır.',
                'image' => 'resim1.jpg',
                'user_id' => 1,
            ],
            // Diğer örnek duyurular buraya eklenir
        ];

        DB::table('duyuru')->insert($duyurular);
    }
}
