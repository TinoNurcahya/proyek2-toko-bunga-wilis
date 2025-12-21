<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // Menampilkan semua pesanan KECUALI yang selesai
    public function index(Request $request)
    {
        $user = $request->user();
        // Ambil pesanan kecuali yang statusnya selesai
        $orders = Pesanan::with(['items.produkUkuran.produk', 'items.produkUkuran.ukuran'])
            ->where('id_users', $user->id_users)
            ->where('status', '!=', 'selesai')
            ->orderBy('tanggal_pesanan', 'desc')
            ->paginate(10);

        return view('profile.pesanan', compact('user', 'orders'));
    }

    // Menampilkan pesanan selesai
    public function pesananSelesai(Request $request)
    {
        $user = $request->user();
        // Ambil hanya pesanan dengan status selesai
        $orders = Pesanan::with(['items.produkUkuran.produk', 'items.produkUkuran.ukuran'])
            ->where('id_users', $user->id_users)
            ->where('status', 'selesai')
            ->orderBy('tanggal_pesanan', 'desc')
            ->paginate(10);

        return view('profile.pesanan-selesai', [
            'user' => $user,
            'orders' => $orders,
            'theme' => 'light'
        ]);
    }

    public function pesananDikirim(Request $request)
    {
        $user = $request->user();
        // Ambil hanya pesanan dengan status dikirim
        $orders = Pesanan::with(['items.produkUkuran.produk', 'items.produkUkuran.ukuran'])
            ->where('id_users', $user->id_users)
            ->where('status', 'dikirim')
            ->orderBy('tanggal_pesanan', 'desc')
            ->paginate(10);

        return view('profile.pesanan-dikirim', [
            'user' => $user,
            'orders' => $orders,
            'theme' => 'light'
        ]);
    }

    public function selesaikan(Request $request, $kode)
    {
        $user = $request->user();

        $order = Pesanan::where('kode_pesanan', $kode)
            ->where('id_users', $user->id_users)
            ->where('status', 'dikirim')
            ->firstOrFail();

        $order->update([
            'status' => 'selesai',
            'tanggal_selesai' => now()
        ]);

        return redirect()->route('profile.pesanan-selesai')
            ->with('success', 'Pesanan berhasil dikonfirmasi sebagai selesai');
    }

    public function detail(Request $request, $kode)
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
