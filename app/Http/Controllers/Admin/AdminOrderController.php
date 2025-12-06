<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminOrder;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = AdminOrder::orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = AdminOrder::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order = AdminOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status berhasil diperbarui');
    }

    public function updateResi(Request $request, $id)
    {
        $request->validate([
            'resi' => 'required'
        ]);

        $order = AdminOrder::findOrFail($id);
        $order->resi = $request->resi;
        $order->save();

        return back()->with('success', 'Nomor resi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $order = AdminOrder::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Pesanan berhasil dihapus');
    }
}
