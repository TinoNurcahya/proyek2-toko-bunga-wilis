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
                'id_produk_ukuran' => 1, // Monstera
                'jumlah' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 3,
                'id_produk_ukuran' => 2,
                'jumlah' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
