<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\ItemPesanan;
use App\Models\AdminOrder;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    public function index()
    {
        $data = Pesanan::where('user_id', auth()->id())->with('items')->orderBy('created_at','desc')->get();
        return view('pesanan.index', compact('data'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama_penerima'=>'required',
            'telepon'=>'required',
            'alamat'=>'required',
            'items'=>'required|array'
        ]);

        // create pesanan user
        $kode = 'P'.time().Str::upper(Str::random(4));
        $total = 0;
        $pesanan = Pesanan::create([
            'user_id'=>auth()->id(),
            'kode_pesanan'=>$kode,
            'nama_penerima'=>$r->nama_penerima,
            'telepon'=>$r->telepon,
            'alamat'=>$r->alamat,
            'metode_pembayaran'=>$r->metode_pembayaran ?? 'Transfer'
        ]);

        foreach($r->items as $it) {
            $subtotal = $it['qty'] * $it['price'];
            ItemPesanan::create([
                'pesanan_id'=>$pesanan->id,
                'nama_produk'=>$it['name'],
                'jumlah'=>$it['qty'],
                'harga_satuan'=>$it['price'],
                'subtotal'=>$subtotal
            ]);
            $total += $subtotal;
        }

        $pesanan->update(['total_harga'=>$total]);

        // make admin_orders mirror entry for admin to process
        AdminOrder::create([
            'order_code'=>$kode,
            'user_id'=>auth()->id(),
            'customer_name'=>$r->nama_penerima,
            'customer_phone'=>$r->telepon,
            'customer_address'=>$r->alamat,
            'product_qty'=>count($r->items),
            'subtotal'=>$total,
            'payment_method'=>$r->metode_pembayaran ?? null,
            'status'=>'MENUNGGU PEMBAYARAN'
        ]);

        return redirect()->route('pesanan.index')->with('success','Pesanan berhasil dibuat.');
    }
}
