<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReviewController;
use \App\Livewire\CheckoutPage;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PesananController;


use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\IotController;

// use App\Livewire\ProductList;    


// === HALAMAN UTAMA ===
Route::get('/', [ProductController::class, 'index'])->name('home');

// === GOOGLE OAUTH ===
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// === ROUTE USER ===
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
    Route::get('/produk/search', [ProductController::class, 'search'])->name('produk.search');
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
// Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });




// === ROUTE ADMIN — FIXED (tidak duplikat lagi) ===
Route::prefix('admin')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('admin.')
    ->group(function () {


        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Dashboard dinamis
        
      Route::get('/dashboard/chart-data', [AdminDashboardController::class, 'chartData'])
              ->name('dashboard.chartData');


        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
        Route::post('/orders/{id}/resi', [AdminOrderController::class, 'updateResi'])->name('orders.resi');
        Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.delete');

        Route::get('/iot', function () {
         return view('admin.iot');
         })->name('iot');

         Route::get('/tanaman', [\App\Http\Controllers\Admin\AdminTanamanController::class, 'index'])
         ->name('tanaman');

    });

// === Redirect setelah login ===
Route::middleware(['auth'])->get('/home', function () {
    $user = Auth::user();

    if (!$user->email_verified_at) {
        return redirect()->route('verification.notice')
            ->with('status', 'Silakan verifikasi email Anda terlebih dahulu.');
    }

    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect('/');
})->name('home');

// === LOGOUT ===
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/logout', function () {
    abort(404);
});


require __DIR__ . '/auth.php';
