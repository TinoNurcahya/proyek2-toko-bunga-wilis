<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FotoProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fotoProduk = [
            // Foto untuk produk id 1
            ['id_produk' => 1, 'foto' => 'uploads/produk/monstera1.jpg'],
            ['id_produk' => 1, 'foto' => 'uploads/produk/monstera2.jpg'],

            // Foto untuk produk id 2
            ['id_produk' => 2, 'foto' => 'uploads/produk/kaktus1.jpg'],
            ['id_produk' => 2, 'foto' => 'uploads/produk/kaktus2.jpg']
        ];

        DB::table('foto_produk')->insert($fotoProduk);
    }
}
