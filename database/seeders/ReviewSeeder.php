<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $produks = Produk::limit(3)->get();
        $users = User::limit(3)->get();

        if ($produks->count() > 0 && $users->count() > 0) {
            Review::create([
                'id_produk' => $produks[0]->id_produk,
                'id_users' => $users[0]->id_users,
                'rating' => 5,
                'komentar' => 'Saya beli tanaman berbunga, warnanya cantik dan bikin kamar lebih hidup. Informasi tanamannya jelas, jadi mudah dirawat.',
                'tanggal_review' => now()->subDays(2),
            ]);

            Review::create([
                'id_produk' => $produks[1]->id_produk,
                'id_users' => $users[1]->id_users,
                'rating' => 5,
                'komentar' => 'Tanaman sampai dengan kondisi segar, packaging rapi dan aman. Seller ramah dan informatif.',
                'tanggal_review' => now()->subDays(5),
            ]);

            Review::create([
                'id_produk' => $produks[2]->id_produk,
                'id_users' => $users[2]->id_users,
                'rating' => 4,
                'komentar' => 'Produk sesuai gambar, tanaman sehat dan perawatannya mudah. Recommended!',
                'tanggal_review' => now()->subDays(7),
            ]);
        }
    }
}
