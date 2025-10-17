<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert([
            [
                'id_kategori' => 1, // indoor
                'id_ukuran' => 2,   // sedang
                'nama' => 'Monstera Deliciosa',
                'harga' => 125000,
                'stok' => 10,
                'foto_utama' => 'images/monstera.jpg',
                'deskripsi' => 'Tanaman hias indoor populer dengan daun besar berlubang.',
                'terjual' => 5,
                'rating' => 4.7,
                'jumlah_rating' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2, // outdoor
                'id_ukuran' => 3,   // besar
                'nama' => 'Palem Kipas',
                'harga' => 175000,
                'stok' => 8,
                'foto_utama' => 'images/palem-kipas.jpg',
                'deskripsi' => 'Tanaman outdoor dengan daun berbentuk kipas, cocok untuk taman.',
                'terjual' => 2,
                'rating' => 4.5,
                'jumlah_rating' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
