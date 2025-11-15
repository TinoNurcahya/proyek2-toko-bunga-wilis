<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Notifikasi;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\DetailTanaman;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),'theme' => 'light'
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Handle foto profil upload
        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::delete('public/' . $user->foto_profil);
            }

            $path = $request->file('foto_profil')->store('profiles', 'public');
            $user->foto_profil = $path;
        }

        // Handle hapus foto jika ada request hapus
        if ($request->has('hapus_foto') && $request->hapus_foto == '1') {
            if ($user->foto_profil) {
                Storage::delete('public/' . $user->foto_profil);
                $user->foto_profil = null;
            }
        }

        // Update field lainnya
        $validatedData = $request->validated();

        $updateData = [
            'nama' => $validatedData['nama'],
            'no_hp' => $validatedData['no_hp'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
        ];

        // Hanya update email jika user bukan Google
        if (!$user->google_id && isset($validatedData['email'])) {
            $updateData['email'] = $validatedData['email'];

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }
        }

        $user->fill($updateData);
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        // jika user menggunakan google, maka skip validasi password
        if ($user->google_id) {
            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        }

        // untuk user biasa, lakukan validasi password
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function editAddress(Request $request): View
    {
        return view('profile.alamat', [
            'user' => $request->user(), 'theme' => 'light'
        ]);
    }

    public function updateAddress(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'alamat' => ['required', 'max:500'],
        ], [
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 500 karakter.',
        ]);

        $request->user()->update($validated);
        return Redirect::route('profile.alamat.edit')->with('status', 'address-updated');
    }

    /**
     * Display the user's notifications.
     */
    public function editNotifications(Request $request): View
    {
        $notifikasi = Notifikasi::where('id_users', $request->user()->id_users)
            ->orderByUnreadFirst()
            ->paginate(10);

        return view('profile.notifikasi', [
            'user' => $request->user(),
            'notifikasi' => $notifikasi,'theme' => 'light'
        ]);
    }

    /**
     * Mark notification as read.
     */
    /**
     * Mark notification as read.
     */
    public function markAsRead(Request $request, $id): JsonResponse|RedirectResponse
    {
        try {
            $notifikasi = Notifikasi::where('id_users', $request->user()->id_users)
                ->where('id_notifikasi', $id)
                ->first();

            if (!$notifikasi) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Notifikasi tidak ditemukan.'
                    ], 404);
                }
                return back()->with('error', 'Notifikasi tidak ditemukan.');
            }

            $notifikasi->update(['status' => 'dibaca']);

            // hitung belum dibaca di navbar
            $unreadCount = Notifikasi::where('id_users', $request->user()->id_users)
                ->where('status', 'belum_dibaca')
                ->count();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Notifikasi telah ditandai sebagai dibaca.',
                    'unreadCount' => $unreadCount
                ]);
            }

            return back()->with('status', 'notifikasi-marked-read');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menandai notifikasi sebagai dibaca.'
                ], 500);
            }
            return back()->with('error', 'Terjadi kesalahan saat menandai notifikasi sebagai dibaca.');
        }
    }

    /**
     * Delete notification.
     */
    public function deleteNotification(Request $request, $id): RedirectResponse
    {
        try {
            $notifikasi = Notifikasi::where('id_users', $request->user()->id_users)
                ->where('id_notifikasi', $id)
                ->first();

            if (!$notifikasi) {
                return back()->with('error', 'Notifikasi tidak ditemukan.');
            }

            $notifikasi->delete();

            return back()->with('status', 'notifikasi-deleted');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus notifikasi.');
        }
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request): RedirectResponse
    {
        try {
            $updated = Notifikasi::where('id_users', $request->user()->id_users)
                ->where('status', 'belum_dibaca')
                ->update(['status' => 'dibaca']);

            if ($updated > 0) {
                return back()->with('status', 'all-notifikasi-marked-read');
            } else {
                return back()->with('info', 'Tidak ada notifikasi yang perlu ditandai sebagai dibaca.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menandai semua notifikasi sebagai dibaca.');
        }
    }

    /**
     * Display the user's cart.
     */
    public function showCart(Request $request): View
    {
        $cartItems = Keranjang::with([
            'produkUkuran.produk.detailTanaman',
            'produkUkuran.ukuran'
        ])
            ->where('id_users', $request->user()->id_users)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            if ($cartItem->produkUkuran) {
                $totalPrice += $cartItem->produkUkuran->harga * $cartItem->jumlah;
            }
        }

        return view('profile.keranjang', [
            'user' => $request->user(),
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,'theme' => 'light'
        ]);
    }

    /**
     * Delete cart item.
     */
    public function deleteCartItem(Request $request, $id): RedirectResponse
    {
        $cartItem = Keranjang::where('id_keranjang', $id)
            ->where('id_users', $request->user()->id_users)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return back()->with('status', 'cart-item-deleted');
        }

        return back()->with('error', 'Item keranjang tidak ditemukan');
    }

    /**
     * Update cart item quantity.
     */
    public function updateQuantity(Request $request, $id): JsonResponse
    {
        $cartItem = Keranjang::with('produkUkuran.produk')
            ->where('id_keranjang', $id)
            ->where('id_users', $request->user()->id_users)
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ], 404);
        }

        $change = (int) $request->input('change');
        $newQuantity = $cartItem->jumlah + $change;

        // Validasi quantity minimal 1
        if ($newQuantity < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Quantity minimal 1'
            ], 400);
        }

        // Validasi stok produk -  akses melalui produkUkuran
        if ($cartItem->produkUkuran && $newQuantity > $cartItem->produkUkuran->stok) {
            return response()->json([
                'success' => false,
                'message' => 'Quantity melebihi stok. Stok tersedia: ' . $cartItem->produkUkuran->stok
            ], 400);
        }

        // Update hanya quantity 
        $cartItem->jumlah = $newQuantity;
        $cartItem->save();

        // Hitung total price baru secara manual
        $cartItems = Keranjang::with('produkUkuran')
            ->where('id_users', $request->user()->id_users)
            ->get();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            if ($item->produkUkuran) {
                $totalPrice += $item->produkUkuran->harga * $item->jumlah;
            }
        }

        $cartCount = $cartItems->count();

        // Ambil data cart items terbaru untuk navbar popup dengan struktur baru
        $cartItemsForNavbar = Keranjang::with([
            'produkUkuran.produk.detailTanaman',
            'produkUkuran.ukuran'
        ])
            ->where('id_users', $request->user()->id_users)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($item) {
                $produkNama = $item->produkUkuran && $item->produkUkuran->produk
                    ? $item->produkUkuran->produk->nama
                    : 'Produk tidak tersedia';

                $foto = $item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->foto_utama
                    ? asset($item->produkUkuran->produk->foto_utama)
                    : asset('images/default-product.jpg');

                $namaIlmiah = $item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->detailTanaman
                    ? $item->produkUkuran->produk->detailTanaman->nama_ilmiah
                    : 'Nama ilmiah tidak tersedia';

                $harga = $item->produkUkuran ? (float) $item->produkUkuran->harga : 0;
                $subtotal = $harga * $item->jumlah;

                return [
                    'id_keranjang' => $item->id_keranjang,
                    'produk_nama' => $produkNama,
                    'ukuran' => $item->produkUkuran && $item->produkUkuran->ukuran
                        ? $item->produkUkuran->ukuran->nama_ukuran
                        : 'Tidak ada ukuran',
                    'produk_foto' => $foto,
                    'nama_ilmiah' => $namaIlmiah,
                    'harga' => $harga,
                    'jumlah' => (int) $item->jumlah,
                    'subtotal' => (float) $subtotal // Hitung manual
                ];
            });

        // Hitung subtotal untuk item yang diupdate
        $newSubtotal = $cartItem->produkUkuran ? $cartItem->produkUkuran->harga * $newQuantity : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'newQuantity' => (int) $newQuantity,
                'newSubtotal' => (float) $newSubtotal, // Gunakan yang dihitung manual
                'newTotalPrice' => (float) $totalPrice,
                'maxStock' => $cartItem->produkUkuran ? (int) $cartItem->produkUkuran->stok : 0
            ],
            'cartCount' => (int) $cartCount,
            'cartItems' => $cartItemsForNavbar
        ]);
    }
}
