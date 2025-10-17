<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // akun admin
        User::create([
            'role' => 'admin',
            'nama' => 'Ghina',
            'email' => 'auliaghinaa75@gmail.com',
            'password' => Hash::make('aaaaaaaa'),
            'alamat' => 'Jl. Merdeka No. 1, Bandung',
            'no_hp' => '081234567890',
            'jenis_kelamin' => 'P',
            'foto_profil' => null,
        ]);
        User::create([
            'role' => 'admin',
            'nama' => 'Tino',
            'email' => 'tinonurcahya@gmail.com',
            'password' => Hash::make('aaaaaaaa'),
            'alamat' => 'Jl. Merdeka No. 1, Bandung',
            'no_hp' => '081234567890',
            'jenis_kelamin' => 'L',
            'foto_profil' => null,
        ]);
        User::create([
            'role' => 'admin',
            'nama' => 'Andika ',
            'email' => 'andikadwiki32@gmail.com',
            'password' => Hash::make('aaaaaaaa'),
            'alamat' => 'Jl. Merdeka No. 1, Bandung',
            'no_hp' => '081234567890',
            'jenis_kelamin' => 'L',
            'foto_profil' => null,
        ]);
        User::create([
            'role' => 'admin',
            'nama' => 'Viola ',
            'email' => 'violainsanputri@gmail.com',
            'password' => Hash::make('aaaaaaaa'),
            'alamat' => 'Jl. Merdeka No. 1, Bandung',
            'no_hp' => '081234567890',
            'jenis_kelamin' => 'P',
            'foto_profil' => null,
        ]);


        // beberapa user biasa
        User::create([
            'role' => 'user',
            'nama' => 'a',
            'email' => 'a@gmail.com',
            'password' => Hash::make('aaaaaaaa'),
            'alamat' => 'Jl. Cendana No. 5',
            'no_hp' => '081298765432',
            'jenis_kelamin' => 'L',
            'foto_profil' => null,
        ]);

        User::create([
            'role' => 'user',
            'nama' => 'b',
            'email' => 'b@gmail.com',
            'password' => Hash::make('bbbbbbbb'),
            'alamat' => 'Jl. Cendana No. 5',
            'no_hp' => '081298765432',
            'jenis_kelamin' => 'L',
            'foto_profil' => null,
        ]);

        User::create([
            'role' => 'user',
            'nama' => 'c',
            'email' => 'c@gmail.com',
            'password' => Hash::make('cccccccc'),
            'alamat' => 'Jl. Cendana No. 5',
            'no_hp' => '081298765432',
            'jenis_kelamin' => 'L',
            'foto_profil' => null,
        ]);
    }
}
