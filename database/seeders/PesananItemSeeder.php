<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pesanan_item')->insert([
            [
                'id_pesanan' => 1,
                'id_produk_ukuran' => 1, // Monstera
                'harga_satuan' => 150000,
                'kuantitas' => 2,
                'subtotal' => 2 * 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pesanan' => 1,
                'id_produk_ukuran' => 2, // kaktus
                'harga_satuan' => 120000,
                'kuantitas' => 1,
                'subtotal' => 1 * 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
