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
                'pesan' => 'Selamat datang di sistem kami!',
                'status' => 'belum_dibaca',
                'tanggal' => Carbon::now()->toDateString(),
            ],
            [
                'id_users' => 3,
                'pesan' => 'Akun kamu berhasil diverifikasi.',
                'status' => 'dibaca',
                'tanggal' => Carbon::now()->subDay()->toDateString(),
            ],
        ]);
    }
}
