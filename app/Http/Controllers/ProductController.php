<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Produk terbaru untuk swiper
        $produkTerbaru = Produk::with(['produkUkuran', 'kategori', 'produkUkuran.ukuran'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Produk paling laris
        $produkTerlaris = Produk::with(['produkUkuran', 'kategori', 'produkUkuran.ukuran'])
            ->orderBy('terjual', 'desc')
            ->take(8)
            ->get();

        $testimonials = Review::with('produk', 'user')
            ->where('rating', '>=', 4)
            ->orderBy('tanggal_review', 'desc')
            ->limit(8)
            ->get();
        return view('welcome', compact('produkTerbaru', 'produkTerlaris', 'testimonials'));
    }

    public function show(Produk $produk)
    {
        return view('user.detail', compact('produk'), ['theme' => 'light']);
    }
}
