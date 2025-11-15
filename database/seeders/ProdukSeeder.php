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
                'nama' => 'Monstera Deliciosa',
                'foto_utama' => 'images/products/monstera.jpg',
                'deskripsi' => 'Tanaman hias indoor populer dengan daun besar berlubang.',
                'terjual' => 5,
                'rating' => 4.7,
                'jumlah_rating' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2, // outdoor
                'nama' => 'Palem Kipas',
                'foto_utama' => 'images/products/palem-kipas.jpg',
                'deskripsi' => 'Tanaman outdoor dengan daun berbentuk kipas, cocok untuk taman.',
                'terjual' => 2,
                'rating' => 4.5,
                'jumlah_rating' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2, // outdoor
                'nama' => 'Mawar Merah',
                'foto_utama' => 'images/products/mawar-merah.jpg',
                'deskripsi' => 'Tanaman outdoor mawar merah, cocok untuk taman.',
                'terjual' => 2,
                'rating' => 4.1,
                'jumlah_rating' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2, // outdoor
                'nama' => 'Coleus',
                'foto_utama' => 'images/products/coleus.jpg',
                'deskripsi' => 'Tanaman outdoor coleus, cocok untuk taman.',
                'terjual' => 2,
                'rating' => 4.1,
                'jumlah_rating' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2, // outdoor
                'nama' => 'Gelombang Cinta',
                'foto_utama' => 'images/products/gelombang-cinta.jpg',
                'deskripsi' => 'Tanaman outdoor Gelombang Cinta, cocok untuk taman.',
                'terjual' => 2,
                'rating' => 4.1,
                'jumlah_rating' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
