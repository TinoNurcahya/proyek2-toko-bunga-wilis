<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReviewController;
use \App\Livewire\CheckoutPage;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PesananController;
// use App\Livewire\ProductList;    
// === Halaman Utama ===
Route::get('/', [ProductController::class, 'index'])->name('home');

// === Google OAuth ===
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// === ROUTES KHUSUS USER (TAMBAHKAN 'verified') ===
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    // PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ALAMAT
    Route::get('/profile/alamat', [ProfileController::class, 'editAddress'])->name('profile.alamat.edit');
    Route::patch('/profile/alamat', [ProfileController::class, 'updateAddress'])->name('profile.alamat.update');

    // NOTIFIKASI
    Route::get('/profile/notifikasi', [ProfileController::class, 'editNotifications'])->name('profile.notifikasi.edit');
    Route::post('/profile/notifikasi/{id}/read', [ProfileController::class, 'markAsRead'])->name('profile.notifikasi.read');
    Route::delete('/notifikasi/{id}', [ProfileController::class, 'deleteNotification'])->name('profile.notifikasi.delete');
    Route::post('/profile/notifikasi/read-all', [ProfileController::class, 'markAllAsRead'])->name('profile.notifikasi.read-all');

    // KERANJANG
    Route::get('/profile/keranjang', [ProfileController::class, 'showCart'])->name('profile.keranjang');
    Route::delete('/profile/keranjang/{id}', [ProfileController::class, 'deleteCartItem'])->name('profile.keranjang.delete');
    Route::post('/profile/keranjang/{id}/update-quantity', [ProfileController::class, 'updateQuantity'])->name('profile.keranjang.update-quantity');

    // PESANAN - GUNAKAN CONTROLLER BARU
    Route::get('/profile/pesanan', [PesananController::class, 'index'])->name('profile.pesanan'); // UPDATE INI
    Route::get('/profile/pesanan/detail/{kode}', [PesananController::class, 'detail'])->name('pesanan.detail'); // TAMBAHKAN INI
    Route::post('/profile/pesanan/batalkan/{kode}', [PesananController::class, 'batalkan'])->name('pesanan.batalkan'); // TAMBAHKAN INI

    // CHECKOUT
    Route::get('/profile/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/pembayaran/midtrans/{kode}', [PaymentController::class, 'midtrans'])->name('pembayaran.midtrans');
    Route::get('/pembayaran/finish/{kode}', [PaymentController::class, 'finish'])->name('pembayaran.finish');
    Route::get('/pembayaran/pending/{kode}', [PaymentController::class, 'pending'])->name('pembayaran.pending');
    Route::get('/pembayaran/error/{kode}', [PaymentController::class, 'error'])->name('pembayaran.error');

    // ROUTE PRODUK
    Route::get('/produk', [ProductController::class, 'list'])->name('produk');
    // Route::get('/produk-livewire', \App\Livewire\ProductList::class)->name('produk.livewire');
    // Route::get('/produk', ProductList::class)->name('produk');
    Route::get('/produk/search', [ProductController::class, 'search'])->name('produk.search');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/produk/{produk}', [ProductController::class, 'show'])->name('produk.detail');

    // ROUTE REVIEW
    // Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    // Route::get('/reviews/create/{produk}', [ReviewController::class, 'create'])->name('reviews.create');
    // Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Webhook Midtrans
Route::post('/midtrans/callback', [PaymentController::class, 'notification']);
Route::post('/pembayaran/notification', [PaymentController::class, 'notification'])
    ->name('pembayaran.notification');

// === ROUTES KHUSUS ADMIN (TAMBAHKAN 'verified') ===
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// === Routes fallback setelah login ===
Route::middleware(['auth'])->get('/home', function () {
    $user = Auth::user();

    // Jika belum verifikasi, redirect halaman verfikasi
    if (!$user->email_verified_at) {
        return redirect()->route('verification.notice')
            ->with('status', 'Silakan verifikasi email Anda terlebih dahulu.');
    }

    // Jika sudah verifikasi, redirect berdasarkan role
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect('/');
    }
})->name('home');

// === Logout ===
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Jika user mengetik /logout di URL secara langsung
Route::get('/logout', function () {
    abort(404);
});

require __DIR__ . '/auth.php';
