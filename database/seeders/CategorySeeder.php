<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate(
            ['slug' => 'tanaman-hias-daun'],
            [
                'name' => 'Tanaman Hias Daun',
                'description' => 'Kumpulan tanaman hias berdaun indah.',
            ]
        );
    }
}
