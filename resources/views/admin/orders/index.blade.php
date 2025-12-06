<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminOrder;

class AdminOrderController extends Controller
{
    // Menampilkan semua pesanan + filter + pagination
    public function index(Request $request)
    {
        $query = AdminOrder::orderBy('created_at', 'desc');

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Pagination (WAJIB supaya withQueryString() tidak error)
        $orders = $query->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = AdminOrder::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Menampilkan form edit status
    public function edit($id)
    {
        $order = AdminOrder::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required']);

        $order = AdminOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', 'Status berhasil diperbarui');
    }

    // Update nomor resi
    public function updateResi(Request $request, $id)
    {
        $request->validate(['resi' => 'required']);

        $order = AdminOrder::findOrFail($id);
        $order->resi = $request->resi;
        $order->save();

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', 'Nomor resi berhasil ditambahkan');
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = AdminOrder::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Pesanan berhasil dihapus');
    }
}
