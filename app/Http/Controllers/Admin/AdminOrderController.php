<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Pesanan::with(['items.produkUkuran.produk'])
            ->orderBy('id_pesanan', 'desc')
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Pesanan::with([
                'user',
                'items.produkUkuran.produk'
            ])
            ->where('id_pesanan', $id)
            ->firstOrFail();

        return view('admin.orders.show', compact('order'));
    }

  public function updateStatus(Request $request, $id)
{
    $order = Pesanan::findOrFail($id);

    $order->update([
        'status' => $request->status
    ]);

    
    return redirect()
        ->route('admin.orders.show', $id)
        ->with('success', 'Status pesanan berhasil diperbarui');
}



public function updateResi(Request $request, $id)
{
    $order = Pesanan::where('id_pesanan',$id)->firstOrFail();
    $order->no_resi = $request->no_resi;
    $order->save();

    return back()->with('success','Resi disimpan');
}


    public function destroy($id)
    {
        Pesanan::where('id_pesanan', $id)->delete();
        return back()->with('success', 'Pesanan dihapus');
    }
}
