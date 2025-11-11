<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukUkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk_ukuran')->insert([
            ['id_produk' => 1, 'id_ukuran' => 1, 'stok' => 10, 'harga' => 50000],  // Mini
            ['id_produk' => 1, 'id_ukuran' => 2, 'stok' => 5, 'harga' => 75000],   // Sedang
            ['id_produk' => 1, 'id_ukuran' => 3, 'stok' => 3, 'harga' => 100000],  // Besar

            // Lidah Mertua
            ['id_produk' => 2, 'id_ukuran' => 1, 'stok' => 15, 'harga' => 30000],  // Mini
            ['id_produk' => 2, 'id_ukuran' => 2, 'stok' => 8, 'harga' => 45000],   // Sedang
            ['id_produk' => 2, 'id_ukuran' => 3, 'stok' => 4, 'harga' => 60000],   // Besar

        ]);
    }
}
