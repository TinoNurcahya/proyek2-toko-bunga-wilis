<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\DashboardController;

// === Halaman Utama ===
Route::get('/', function () {
    return view('welcome');
});

// === Google OAuth ===
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// === ROUTES KHUSUS USER (TAMBAHKAN 'verified') ===
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
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
});

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