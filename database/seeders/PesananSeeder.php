<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pesanan')->insert([
            [
                'id_users' => 2,
                'total_harga' => 420000, // dari subtotal keranjang user 2
                'status' => 'menunggu',
                'metode_pembayaran' => 'transfer_bank',
                'tanggal_pesanan' => now(),
                'alamat_pengiriman' => 'Jl. Mawar No. 123, Bandung',
                'snap_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 3,
                'total_harga' => 270000,
                'status' => 'diproses',
                'metode_pembayaran' => 'midtrans',
                'tanggal_pesanan' => now()->subDays(1),
                'alamat_pengiriman' => 'Jl. Anggrek No. 45, Jakarta',
                'snap_token' => 'SNAP-TOKEN-EXAMPLE-123',
                'created_at' => now()->subDays(1),
                'updated_at' => now(),
            ],
        ]);
    }
}
