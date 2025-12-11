<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Pesanan::with(['user', 'items.produkUkuran.produk'])
                        ->orderBy('id_pesanan', 'desc')
                        ->get();

        return view('admin.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Pesanan::with(['user', 'items.produk'])
                        ->where('id_pesanan', $id)
                        ->firstOrFail();

        return view('admin.order-detail', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order = Pesanan::where('id_pesanan', $id)->firstOrFail();
        $order->status = strtolower($request->status);
        $order->save();

        return back()->with('success', 'Status berhasil diperbarui!');
    }
}
