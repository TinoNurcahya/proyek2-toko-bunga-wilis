<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
  public function index()
  {
    try {
      $user = Auth::user();

      // Ambil semua review milik user dengan pagination
      $reviews = Review::with(['produk', 'pesanan'])
        ->where('id_users', $user->id_users)
        ->orderBy('tanggal_review', 'desc')
        ->paginate(10);

      // Hitung statistik
      $totalReviews = $reviews->total();
      $averageRating = $reviews->avg('rating') ?? 0;
      $fiveStarCount = Review::where('id_users', $user->id_users)
        ->where('rating', 5)
        ->count();

      return view('profile.ulasan', [
        'reviews' => $reviews,
        'totalReviews' => $totalReviews,
        'averageRating' => $averageRating,
        'fiveStarCount' => $fiveStarCount,
        'user' => $user,
        'theme' => 'light'
      ]);
    } catch (\Exception $e) {
      Log::error('Error in ReviewController@index: ' . $e->getMessage());
      return redirect()->route('profile')
        ->with('error', 'Terjadi kesalahan saat memuat ulasan.');
    }
  }

  /**
   * Tampilkan form untuk membuat review baru
   */
  public function create($order_id)
  {
    try {
      $order = Pesanan::with([
        'items.produkUkuran.produk',
        'items.produkUkuran.ukuran',
        'reviews.produk',
        'reviews.user'
      ])->findOrFail($order_id);

      if ($order->id_users != Auth::user()->id_users) {
        return redirect()->route('profile.pesanan')
          ->with('error', 'Anda tidak memiliki akses untuk menilai pesanan ini.');
      }

      if ($order->status !== 'selesai') {
        return redirect()->route('profile.pesanan')
          ->with('error', 'Hanya pesanan yang sudah selesai yang bisa direview.');
      }

      $unreviewedProducts = $order->produkBelumDireview();

      if ($unreviewedProducts->isEmpty()) {
        return redirect()->route('profile.pesanan')
          ->with('info', 'Semua produk dalam pesanan ini sudah Anda review.');
      }

      $user = Auth::user();

      return view('profile.reviews.create', [
        'order' => $order,
        'unreviewedProducts' => $unreviewedProducts,
        'user' => $user,
        'theme' => 'light'
      ]);
    } catch (\Exception $e) {
      Log::error('Error in ReviewController@create: ' . $e->getMessage());
      return redirect()->route('profile.pesanan')
        ->with('error', 'Pesanan tidak ditemukan atau terjadi kesalahan.');
    }
  }

  /**
   * Simpan review baru
   */
  public function store(Request $request)
  {
    // Validasi input
    $validator = Validator::make($request->all(), [
      'id_pesanan' => 'required|exists:pesanan,id_pesanan',
      'rating' => 'required|array|min:1',
      'rating.*' => 'required|integer|between:1,5',
      'komentar' => 'nullable|array',
      'komentar.*' => 'nullable|string|max:1000',
      'id_produk' => 'required|array|min:1',
      'id_produk.*' => 'required|exists:produk,id_produk',
    ], [
      'rating.required' => 'Harap berikan rating untuk semua produk.',
      'rating.*.between' => 'Rating harus antara 1 sampai 5.',
      'komentar.*.max' => 'Komentar maksimal 1000 karakter.',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    try {
      $order = Pesanan::findOrFail($request->id_pesanan);

      // Validasi kepemilikan
      if ($order->id_users != Auth::user()->id_users) {
        return redirect()->route('profile.pesanan')
          ->with('error', 'Anda tidak memiliki akses untuk menilai pesanan ini.');
      }

      // Validasi status
      if ($order->status !== 'selesai') {
        return redirect()->route('profile.pesanan')
          ->with('error', 'Hanya pesanan yang sudah selesai yang bisa direview.');
      }

      $successCount = 0;
      $errors = [];
      $reviewedProductIds = [];

      foreach ($request->id_produk as $index => $id_produk) {
        $existingReview = Review::where('id_pesanan', $order->id_pesanan)
          ->where('id_produk', $id_produk)
          ->where('id_users', Auth::user()->id_users)
          ->first();

        if ($existingReview) {
          $errors[] = "Produk sudah Anda review sebelumnya.";
          continue;
        }

        if (isset($request->rating[$index])) {
          try {
            Review::create([
              'id_pesanan' => $order->id_pesanan,
              'id_produk' => $id_produk,
              'id_users' => Auth::user()->id_users,
              'rating' => $request->rating[$index],
              'komentar' => $request->komentar[$index] ?? null,
              'tanggal_review' => now(),
            ]);
            $successCount++;
            $reviewedProductIds[] = $id_produk;
          } catch (\Exception $e) {
            Log::error('Error creating review for product ' . $id_produk . ': ' . $e->getMessage());
            $errors[] = "Gagal menyimpan review untuk produk #" . $id_produk;
          }
        }
      }

      // UPDATE RATING PRODUK
      if (!empty($reviewedProductIds)) {
        foreach (array_unique($reviewedProductIds) as $productId) {
          $this->updateProductRating($productId);
        }
      }

      // Clear cache
      Cache::forget('testimonials-high-rating');
      foreach ($reviewedProductIds as $id_produk) {
        Cache::forget('product-reviews-' . $id_produk);
      }

      if ($successCount > 0) {
        $message = "{$successCount} review berhasil ditambahkan!";
        if (!empty($errors)) {
          $message .= ' Beberapa masalah: ' . implode(' ', array_unique($errors));
        }
        return redirect()->route('profile.pesanan')
          ->with('success', $message);
      } else {
        return redirect()->back()
          ->with('error', 'Gagal menambahkan review. ' . implode(' ', array_unique($errors)))
          ->withInput();
      }
    } catch (\Exception $e) {
      Log::error('Error in ReviewController@store: ' . $e->getMessage());
      return redirect()->back()
        ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Tampilkan form edit review
   */
  public function edit($id)
  {
    try {
      $review = Review::with([
        'produk',
        'pesanan' => function ($query) {
          $query->with(['items.produkUkuran.ukuran']);
        }
      ])->where('id_review', $id)->firstOrFail();

      if (Auth::user()->role !== 'admin' && $review->id_users != Auth::user()->id_users) {
        abort(403, 'Anda tidak memiliki izin untuk mengedit review ini.');
      }

      $item = null;
      $ukuran = null;

      // Pastikan pesanan dan items ada
      if ($review->pesanan && $review->pesanan->relationLoaded('items')) {
        $item = $review->pesanan->items->first(function ($pesananItem) use ($review) {
          return $pesananItem->id_produk == $review->id_produk;
        });

        // Jika tidak ditemukan
        if (!$item && $review->pesanan->items->isNotEmpty()) {
          $item = $review->pesanan->items->where('id_produk', $review->id_produk)->first();

          if (!$item) {
            $item = $review->pesanan->items->first();
          }
        }

        // Ambil ukuran
        if ($item) {
          if ($item->relationLoaded('produkUkuran') && $item->produkUkuran && $item->produkUkuran->ukuran) {
            $ukuran = $item->produkUkuran->ukuran;
          } elseif ($item->ukuran ?? false) {
            $ukuran = (object)['nama_ukuran' => $item->ukuran];
          }
        }
      }

      return view('profile.reviews.edit', [
        'review' => $review,
        'item' => $item,
        'ukuran' => $ukuran,
        'user' => Auth::user(),
        'theme' => 'light'
      ]);
    } catch (\Exception $e) {
      Log::error('Error in ReviewController@edit: ' . $e->getMessage());
      return redirect()->route('profile.ulasan')
        ->with('error', 'Review tidak ditemukan.');
    }
  }

  /**
   * Update review
   */
  public function update(Request $request, $id)
  {
    try {
      $review = Review::where('id_review', $id)->firstOrFail();

      if (Auth::user()->role !== 'admin' && $review->id_users != Auth::user()->id_users) {
        abort(403, 'Anda tidak memiliki izin untuk mengedit review ini.');
      }

      $request->validate([
        'rating' => 'required|integer|between:1,5',
        'komentar' => 'nullable|string|max:1000',
      ]);

      $review->update([
        'rating' => $request->rating,
        'komentar' => $request->komentar,
      ]);

      // Update product rating if changed
      if ($review->wasChanged('rating')) {
        $this->updateProductRating($review->id_produk);
      }

      Cache::forget('testimonials-high-rating');
      Cache::forget('product-reviews-' . $review->id_produk);

      return redirect()->route('profile.ulasan')
        ->with('success', 'Review berhasil diperbarui!');
    } catch (\Exception $e) {
      Log::error('Error in ReviewController@update: ' . $e->getMessage());
      return redirect()->back()
        ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
        ->withInput();
    }
  }

  /**
   * Hapus review
   */
  public function destroy($id)
  {
    try {
      $review = Review::where('id_review', $id)->firstOrFail();

      // Validasi kepemilikan
      if (Auth::user()->role !== 'admin' && $review->id_users != Auth::user()->id_users) {
        abort(403, 'Anda tidak memiliki izin untuk menghapus review ini.');
      }

      $productId = $review->id_produk;
      $review->delete();

      // Update rating produk setelah delete
      $this->updateProductRating($productId);

      // Clear cache
      Cache::forget('testimonials-high-rating');
      Cache::forget('product-reviews-' . $productId);

      return redirect()->route('profile.ulasan')
        ->with('success', 'Review berhasil dihapus!');
    } catch (\Exception $e) {
      Log::error('Error in ReviewController@destroy: ' . $e->getMessage());
      return redirect()->route('profile.ulasan')
        ->with('error', 'Terjadi kesalahan saat menghapus review.');
    }
  }

  /**
   * Tampilkan semua review untuk produk tertentu
   */
  public function showProductReviews($productId)
  {
    return redirect()->route('products.show', ['id' => $productId])
      ->with('tab', 'reviews');
  }

  /**
   * Helper method untuk update rating produk
   */
  private function updateProductRating($productId)
  {
    try {
      $product = Produk::find($productId);
      if (!$product) {
        Log::warning('Product not found for rating update: ' . $productId);
        return;
      }

      // Hitung rating dari semua review produk ini
      $reviews = Review::where('id_produk', $productId)->get();

      if ($reviews->count() > 0) {
        $totalRating = $reviews->sum('rating');
        $averageRating = $totalRating / $reviews->count();

        // Update produk
        $product->update([
          'rating' => round($averageRating, 2),
          'jumlah_rating' => $reviews->count(),
        ]);

        Log::info("Product {$productId} rating updated: {$averageRating} from {$reviews->count()} reviews");
      } else {
        // Reset jika tidak ada review
        $product->update([
          'rating' => 0,
          'jumlah_rating' => 0,
        ]);
        Log::info("Product {$productId} rating reset to 0 (no reviews)");
      }

      // Clear cache untuk produk ini
      Cache::forget('product-' . $productId);
      Cache::forget('product-reviews-' . $productId);
    } catch (\Exception $e) {
      Log::error('Error updating product rating for product ' . $productId . ': ' . $e->getMessage());
    }
  }
}
