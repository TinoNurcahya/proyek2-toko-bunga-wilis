<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminTanamanController extends Controller
{
    public function index()
    {
        // Ambil semua produk + foto + kategori + detail tanaman
        $produk = Produk::with(['detailTanaman', 'kategori'])->get();

        return view('admin.kelola-tanaman', compact('produk'));
    }
}
