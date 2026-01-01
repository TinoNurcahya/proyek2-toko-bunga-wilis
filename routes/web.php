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
use Illuminate\Notifications\Notifiable;


use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminTanamanController;
use App\Http\Controllers\Admin\IotController;
use App\Http\Controllers\Admin\IotDashboardController;

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
    Route::get('/profile/pesanan', [PesananController::class, 'index'])->name('profile.pesanan');
    Route::get('/profile/pesanan-selesai', [PesananController::class, 'pesananSelesai'])->name('profile.pesanan-selesai');
    Route::get('/profile/pesanan-dikirim', [PesananController::class, 'pesananDikirim'])->name('profile.pesanan-dikirim');
    Route::post('/profile/pesanan/selesaikan/{kode}', [PesananController::class, 'selesaikan'])->name('pesanan.selesaikan');
    Route::get('/profile/pesanan/detail/{kode}', [PesananController::class, 'detail'])->name('pesanan.detail');
    Route::post('/profile/pesanan/batalkan/{kode}', [PesananController::class, 'batalkan'])->name('pesanan.batalkan');

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

    // ROUTE ULASAN
    Route::get('/profile/ulasan', [ReviewController::class, 'index'])
        ->name('profile.ulasan');
    Route::get('/orders/{order_id}/review', [ReviewController::class, 'create'])
        ->name('reviews.create');
    Route::post('/reviews/store', [ReviewController::class, 'store'])
        ->name('reviews.store');
    Route::get('/profile/ulasan/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/ulasan/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/ulasan/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Webhook Midtrans
Route::post('/midtrans/callback', [PaymentController::class, 'notification']);
Route::post('/pembayaran/notification', [PaymentController::class, 'notification'])
    ->name('pembayaran.notification');

// === ROUTES KHUSUS ADMIN (TAMBAHKAN 'verified') ===
// Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });




// === ROUTE ADMIN — FIXED  ===
Route::prefix('admin')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/dashboard/produk-terlaris',
            [AdminDashboardController::class, 'produkTerlaris']
        )->name('dashboard.produkTerlaris');

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Dashboard dinamis
        Route::get('/dashboard/chart-data', [AdminDashboardController::class, 'chartData'])
            ->name('dashboard.chartData');

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.status');
        Route::put('/orders/{id}', [AdminOrderController::class, 'update'])
            ->name('orders.update');

        // Tanaman
        Route::get('/tanaman', [AdminTanamanController::class, 'index'])->name('tanaman');
        Route::get('/tanaman/create', [AdminTanamanController::class, 'create'])->name('tanaman.create');
        Route::post('/tanaman', [AdminTanamanController::class, 'store'])->name('tanaman.store');
        Route::get('/tanaman/{id}', [AdminTanamanController::class, 'show'])->name('tanaman.show');
        Route::get('/tanaman/{id}/edit', [AdminTanamanController::class, 'edit'])->name('tanaman.edit');
        Route::put('/tanaman/{id}', [AdminTanamanController::class, 'update'])->name('tanaman.update');
        Route::delete('/tanaman/{id}', [AdminTanamanController::class, 'destroy'])->name('tanaman.destroy');
        Route::get('/tanaman/foto/{id}/hapus', [AdminTanamanController::class, 'hapusFoto'])->name('tanaman.hapus-foto');
        Route::get('/tanaman/{id}/penyiraman', [AdminTanamanController::class, 'penyiraman'])->name('tanaman.penyiraman');

        // IoT
        Route::get('/iot', [IotDashboardController::class, 'index'])->name('iot');
        Route::get('/iot/data', [IotDashboardController::class, 'data'])->name('iot.data');
        Route::post('/iot/pump', [IotDashboardController::class, 'pump'])->name('iot.pump');

        // Notifikasi
        // Route::get('/notifikasi/baca/{id}', function ($id) {
        //     $notif = auth()->user()->notifications()->findOrFail($id);
        //     $notif->markAsRead();

        //     if (!empty($notif->data['order_id'])) {
        //         return redirect()->route('admin.orders.show', $notif->data['order_id']);
        //     }

        //     return back();
        // })->name('notifikasi.baca');
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
