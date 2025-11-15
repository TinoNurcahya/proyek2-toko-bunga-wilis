<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetunjukPerawatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('petunjuk_perawatan')->insert([
            [
                'id_produk' => 1, // Monstera Deliciosa
                'penyiraman' => 'Disiram 2 kali per minggu atau saat tanah mulai kering.',
                'cahaya' => 'Tempatkan di area dengan cahaya terang tidak langsung.',
                'suhu_dan_kelembapan' => 'Suhu ideal 20–30°C dengan kelembapan sedang-tinggi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_produk' => 2,
                'penyiraman' => 'Disiram 1 kali per 10-14 hari, hindari tanah terlalu lembap.',
                'cahaya' => 'Butuh sinar matahari penuh setidaknya 6 jam sehari.',
                'suhu_dan_kelembapan' => 'Suhu 25–35°C, kelembapan rendah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_produk' => 3,
                'penyiraman' => 'Disiram 1 kali per 10-14 hari, hindari tanah terlalu lembap.',
                'cahaya' => 'Butuh sinar matahari penuh setidaknya 6 jam sehari.',
                'suhu_dan_kelembapan' => 'Suhu 25–35°C, kelembapan rendah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_produk' => 4,
                'penyiraman' => 'Disiram 1 kali per 10-14 hari, hindari tanah terlalu lembap.',
                'cahaya' => 'Butuh sinar matahari penuh setidaknya 6 jam sehari.',
                'suhu_dan_kelembapan' => 'Suhu 25–35°C, kelembapan rendah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_produk' => 5,
                'penyiraman' => 'Disiram 1 kali per 10-14 hari, hindari tanah terlalu lembap.',
                'cahaya' => 'Butuh sinar matahari penuh setidaknya 6 jam sehari.',
                'suhu_dan_kelembapan' => 'Suhu 25–35°C, kelembapan rendah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
