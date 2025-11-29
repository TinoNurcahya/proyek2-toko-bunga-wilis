<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        return view('reviews.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'required|string|max:1000',
        ]);

        // Cek duplicate review
        $existingReview = Review::where('id_produk', $request->id_produk)
            ->where('id_users', Auth::user()->id_users)
            ->first();

        if ($existingReview) {
            return redirect()->back()
                ->with('error', 'Anda sudah memberikan review untuk produk ini!');
        }

        // Create review
        $review = Review::create([
            'id_produk' => $request->id_produk,
            'id_users' => Auth::user()->id_users,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'tanggal_review' => now(),
        ]);

        // Clear cache
        Cache::forget('testimonials-high-rating');

        return redirect()->route('produk.show', $request->id_produk)
            ->with('success', 'Review berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Authorization check - PAKAI id_users
        if (Auth::user()->role !== 'admin' && $review->id_users !== Auth::user()->id_users) {
            abort(403, 'Unauthorized action.');
        }

        $id_produk = $review->id_produk;

        // Delete review - auto-update akan ter-trigger otomatis
        $review->delete();

        // Clear cache
        Cache::forget('testimonials-high-rating');

        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }
}
