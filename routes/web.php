<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AdminOrderController;

// === HALAMAN UTAMA ===
Route::get('/', [ProductController::class, 'index'])->name('home');

// === GOOGLE OAUTH ===
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// === ROUTE USER ===
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/alamat', [ProfileController::class, 'editAddress'])->name('profile.alamat.edit');
    Route::patch('/profile/alamat', [ProfileController::class, 'updateAddress'])->name('profile.alamat.update');

    Route::get('/profile/notifikasi', [ProfileController::class, 'editNotifications'])->name('profile.notifikasi.edit');
    Route::post('/profile/notifikasi/{id}/read', [ProfileController::class, 'markAsRead'])->name('profile.notifikasi.read');
    Route::delete('/notifikasi/{id}', [ProfileController::class, 'deleteNotification'])->name('profile.notifikasi.delete');
    Route::post('/profile/notifikasi/read-all', [ProfileController::class, 'markAllAsRead'])->name('profile.notifikasi.read-all');

    Route::get('/profile/keranjang', [ProfileController::class, 'showCart'])->name('profile.keranjang');
    Route::delete('/profile/keranjang/{id}', [ProfileController::class, 'deleteCartItem'])->name('profile.keranjang.delete');
    Route::post('/profile/keranjang/{id}/update-quantity', [ProfileController::class, 'updateQuantity'])->name('profile.keranjang.update-quantity');

    // PRODUK
    Route::get('/produk', [ProductController::class, 'list'])->name('produk');
    Route::get('/produk/search', [ProductController::class, 'search'])->name('produk.search');
    Route::get('/produk/{produk}', [ProductController::class, 'show'])->name('produk.detail');

    // REVIEW
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/create/{produk}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// === ROUTE ADMIN — FIXED (tidak duplikat lagi) ===
Route::prefix('admin')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

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
