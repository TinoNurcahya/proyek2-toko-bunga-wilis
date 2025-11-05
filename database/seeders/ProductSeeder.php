<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

class ProductSeeder extends Seeder
{
    
    public function run(): void
{
   $category = Category::where('slug', 'tanaman-hias-daun')->first();

if (!$category) {
    $this->command->error('Kategori "tanaman-hias-daun" belum ada!');
    return;
}

$product = Product::firstOrCreate(
    ['slug' => 'janda-bolong'],
    [
        'category_id' => $category->id,
        'name' => 'Janda Bolong',
        'scientific_name' => 'Monstera deliciosa',
        'origin' => 'Hutan tropis Amerika Tengah',
        'size' => 'Tinggi ± 40–60 cm',
        'description' => "Monstera Deliciosa adalah tanaman hias premium...",
        'care_instructions' => "Penyiraman: 2x seminggu\nCahaya: Tidak langsung\nSuhu: 18–28°C",
        'price' => 250000,
        'stock' => 124,
        'rating' => 4.5,
        'sold_count' => 50,
        'image' => 'products/monstera.jpg',
    ]
);

    

    // buat review
    \App\Models\Review::firstOrCreate(
        ['product_id' => $product->id, 'user_name' => 'Sarah M.'],
        [
            'rating' => 5,
            'comment' => 'Daunnya besar dan segar sekali, sesuai foto di katalog!',
            'review_date' => '2024-12-15',
        ]
    );
}
}