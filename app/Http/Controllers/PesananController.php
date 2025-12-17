<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = Pesanan::with([
                'items.produkUkuran.produk',
                'items.produkUkuran.ukuran'
            ])
            ->where('id_users', $user->id_users)
            ->orderBy('tanggal_pesanan', 'desc')
            ->paginate(10);

        return view('profile.pesanan', compact('user', 'orders'));
    }

    public function detail($kode)
    {
        $user = Auth::user();

        $order = Pesanan::with([
                'items.produkUkuran.produk',
                'items.produkUkuran.ukuran',
                'user'
            ])
            ->where('kode_pesanan', $kode)
            ->where('id_users', $user->id_users)
            ->firstOrFail();

        return view('profile.pesanan-detail', compact('user', 'order'));
    }

    public function batalkan($kode)
    {
        $user = Auth::user();

        $order = Pesanan::where('kode_pesanan', $kode)
            ->where('id_users', $user->id_users)
            ->where('status', 'pending') // FIX STATUS
            ->firstOrFail();

        $order->update(['status' => 'dibatalkan']);

        return redirect()
            ->route('profile.pesanan')
            ->with('success', 'Pesanan berhasil dibatalkan');
    }
}
