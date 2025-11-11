<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function show($slug)
{
    $product = Product::with(['category', 'reviews'])->where('slug', $slug)->firstOrFail();

    // Ambil produk lain di kategori yang sama
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

    return view('products.show', compact('product', 'relatedProducts'));
}
}