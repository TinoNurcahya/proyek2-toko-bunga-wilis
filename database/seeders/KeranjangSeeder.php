<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeranjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('keranjang')->insert([
            [
                'id_users' => 2, // User kedua
                'id_produk' => 1, // Monstera
                'jumlah' => 2,
                'subtotal' => 2 * 150000, // harga contoh 150rb
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 3, // User ketiga
                'id_produk' => 2, // Kaktus Golden Barrel
                'jumlah' => 3,
                'subtotal' => 3 * 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
