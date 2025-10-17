<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ukuran')->insert([
            ['nama_ukuran' => 'Mini'],
            ['nama_ukuran' => 'Sedang'],
            ['nama_ukuran' => 'Besar'],
            ['nama_ukuran' => 'Ekstra Besar'],
        ]);
    }
}
