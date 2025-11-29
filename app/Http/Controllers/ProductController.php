<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Review;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Produk terbaru untuk swiper
        $produkTerbaru = Produk::with(['produkUkuran', 'kategori', 'produkUkuran.ukuran'])
            ->whereHas('produkUkuran', function ($query) {
                $query->where('stok', '>', 0);
            })
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Produk paling laris
        $produkTerlaris = Produk::with(['produkUkuran', 'kategori', 'produkUkuran.ukuran'])
            ->whereHas('produkUkuran', function ($query) {
                $query->where('stok', '>', 0);
            })
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
        // Eager load relationships termasuk reviews dengan user
        $produk->load([
            'produkUkuran',
            'detailTanaman',
            'petunjukPerawatan',
            'produkUkuran.ukuran',
            'reviews.user'
        ]);

        // Ambil 4 produk random dari kategori yang sama
        $relatedProducts = Produk::with('produkUkuran')
            ->where('id_kategori', $produk->id_kategori)
            ->where('id_produk', '!=', $produk->id_produk)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('user.detail', compact('produk', 'relatedProducts'), ['theme' => 'light']);
    }

    public function list()
    {
        $produk = Produk::with(['produkUkuran', 'kategori', 'produkUkuran.ukuran'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data kategori
        $kategories = Kategori::withCount('produk')
            ->has('produk')
            ->orderBy('nama_kategori')
            ->get();

        return view('user.produk', compact('produk', 'kategories'));
    }
}
