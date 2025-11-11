<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifikasi')->insert([
            [
                'id_users' => 2,
                'judul' => 'Login',
                'pesan' => 'Selamat datang di sistem kami!',
                'status' => 'belum_dibaca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 2,
                'judul' => 'verifikasi',
                'pesan' => 'Akun kamu berhasil diverifikasi.',
                'status' => 'dibaca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 2,
                'judul' => 'daftar',
                'pesan' => 'Selamat datang di sistem kami!',
                'status' => 'belum_dibaca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 2,
                'judul' => 'Peringatan Keamanan',
                'pesan' => 'Pastikan password kamu kuat dan aman.',
                'status' => 'belum_dibaca',
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            [
                'id_users' => 2,
                'judul' => 'Pembaruan Kebijakan',
                'pesan' => 'Kebijakan privasi kami telah diperbarui.',
                'status' => 'dibaca',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(6),
            ],
            [
                'id_users' => 2,
                'judul' => 'Produk Baru',
                'pesan' => 'Cek produk baru yang tersedia di toko kami.',
                'status' => 'dibaca',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(4),
            ],
            [
                'id_users' => 2,
                'judul' => 'Pembaruan Profil',
                'pesan' => 'Profil kamu berhasil diperbarui.',
                'status' => 'dibaca',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(1),
            ],
            [
                'id_users' => 2,
                'judul' => 'Pemesanan Diterima',
                'pesan' => 'Pesanan #ORD001 kamu telah diterima.',
                'status' => 'belum_dibaca',
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],
            [
                'id_users' => 2,
                'judul' => 'Pengiriman Diproses',
                'pesan' => 'Pesanan #ORD001 sedang dalam proses pengiriman.',
                'status' => 'belum_dibaca',
                'created_at' => now()->subHours(4),
                'updated_at' => now()->subHours(4),
            ],
            [
                'id_users' => 2,
                'judul' => 'Pembayaran Berhasil',
                'pesan' => 'Pembayaran untuk pesanan #ORD002 berhasil.',
                'status' => 'dibaca',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'id_users' => 2,
                'judul' => 'Pesanan Dikirim',
                'pesan' => 'Pesanan #ORD003 telah dikirim. No resi: RESI123456',
                'status' => 'belum_dibaca',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'id_users' => 2,
                'judul' => 'Pesanan Sampai',
                'pesan' => 'Pesanan #ORD004 telah sampai di tujuan.',
                'status' => 'dibaca',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1),
            ],
        ]);
    }
}
