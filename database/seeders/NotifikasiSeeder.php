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
        ]);
    }
}
