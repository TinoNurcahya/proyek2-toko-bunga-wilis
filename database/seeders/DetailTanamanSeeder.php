<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_tanaman')->insert([
            [
                'id_produk' => 1,
                'nama_ilmiah' => 'Monstera deliciosa',
                'ukuran_detail' => 'Tinggi ±60 cm',
                'asal_tanaman' => 'Meksiko & Amerika Tengah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_produk' => 2,
                'nama_ilmiah' => 'Echinocactus grusonii',
                'ukuran_detail' => 'Diameter ±25 cm',
                'asal_tanaman' => 'Meksiko',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
