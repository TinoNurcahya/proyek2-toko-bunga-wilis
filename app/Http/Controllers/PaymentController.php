<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct()
    {
        $this->midtransService = new MidtransService();
    }

    public function midtrans($kode)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode)
            ->where('id_users', Auth::id())
            ->firstOrFail();

        // Redirect jika sudah dibayar
        if ($pesanan->status == 'dibayar') {
            return redirect()->route('pembayaran.finish', $kode);
        }

        // Redirect jika dibatalkan
        if ($pesanan->status == 'dibatalkan') {
            return redirect()->route('pembayaran.error', $kode);
        }

        // Generate token baru jika expired atau belum ada
        if (!$pesanan->snap_token || $pesanan->status == 'menunggu') {
            $snapToken = $this->midtransService->createTransaction($pesanan);
            $pesanan->update(['snap_token' => $snapToken]);
        }

        return view('user.pembayaran.midtrans', [
            'pesanan' => $pesanan,
            'clientKey' => config('midtrans.client_key'),
            'snapToken' => $pesanan->snap_token,
            'user' => Auth::user(),
            'theme' => 'light'
        ]);
    }

    public function finish($kode)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode)
            ->where('id_users', Auth::id())
            ->firstOrFail();

        // Refresh status dari database
        $pesanan->refresh();

        return view('user.pembayaran.finish', [
            'pesanan' => $pesanan,
            'user' => Auth::user(),
            'theme' => 'light'
        ]);
    }

    public function pending($kode)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode)
            ->where('id_users', Auth::id())
            ->firstOrFail();

        return view('user.pembayaran.pending', [
            'pesanan' => $pesanan,
            'user' => Auth::user(),
            'theme' => 'light'
        ]);
    }

    public function error($kode)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode)
            ->where('id_users', Auth::id())
            ->firstOrFail();

        return view('user.pembayaran.error', [
            'pesanan' => $pesanan,
            'user' => Auth::user(),
            'theme' => 'light'
        ]);
    }

    public function notification(Request $request)
    {
        $result = $this->midtransService->handleNotification($request);

        $data = json_decode($request->getContent());

        $pesanan = Pesanan::where('kode_pesanan', $data->order_id)->first();

        if (!$pesanan) {
            return response()->json(['status' => 'error', 'message' => 'Pesanan tidak ditemukan'], 404);
        }

        $pesanan->metode_pembayaran = $data->payment_type;

        if ($data->payment_type === 'bank_transfer') {
            $pesanan->bank = $data->va_numbers[0]->bank ?? null;
            $pesanan->va_number = $data->va_numbers[0]->va_number ?? null;
        }

        $statusMap = [
            'capture' => 'dibayar',
            'settlement' => 'dibayar',
            'pending' => 'menunggu',
            'deny' => 'dibatalkan',
            'expire' => 'dibatalkan',
            'cancel' => 'dibatalkan',
        ];

        $pesanan->status = $statusMap[$data->transaction_status] ?? 'menunggu';


        $pesanan->save();

        return response()->json(['status' => 'success']);
    }
}
