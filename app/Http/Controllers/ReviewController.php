<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
            ->where('id_users', auth()->id())
            ->first();

        if ($existingReview) {
            return redirect()->back()
                ->with('error', 'Anda sudah memberikan review untuk produk ini!');
        }

        $review = Review::create([
            'id_produk' => $request->id_produk,
            'id_users' => auth()->id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'tanggal_review' => now(),
        ]);

        // UPDATE: Clear cache agar testimonial real-time update
        Cache::forget('testimonials-high-rating');

        $this->updateProductRating($request->id_produk);

        return redirect()->route('produk.show', $request->id_produk)
            ->with('success', 'Review berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Authorization check
        if (auth()->user()->role !== 'admin' && $review->id_users !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $id_produk = $review->id_produk;
        $review->delete();

        // UPDATE: Clear cache agar testimonial real-time update
        Cache::forget('testimonials-high-rating');

        // Update rating produk setelah hapus review
        $this->updateProductRating($id_produk);

        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }

    private function updateProductRating($id_produk)
    {
        $produk = Produk::find($id_produk);

        if ($produk) {
            $ratingData = Review::where('id_produk', $id_produk)
                ->selectRaw('AVG(rating) as rata_rata, COUNT(*) as jumlah')
                ->first();

            $produk->update([
                'rating' => $ratingData->rata_rata ?? 0,
                'jumlah_rating' => $ratingData->jumlah ?? 0
            ]);
        }
    }
}