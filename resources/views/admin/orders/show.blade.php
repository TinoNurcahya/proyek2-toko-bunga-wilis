@extends('layouts.admin')
@section('title','Detail Pesanan')

@section('content')
<h3>Detail Pesanan #{{ $order->order_code }}</h3>

<div class="row">
    <div class="col-md-6">
        <div class="card p-3">
            <h5>Informasi Customer</h5>
            <p><strong>Nama:</strong> {{ $order->customer_name ?? ($order->user->name ?? '-') }}</p>
            <p><strong>Telepon:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Alamat:</strong> {{ $order->customer_address }}</p>
            <p><strong>Metode:</strong> {{ $order->payment_method }}</p>
            <p><strong>Bukti:</strong>
                @if($order->payment_proof)
                    <a href="{{ asset('storage/'.$order->payment_proof) }}" target="_blank">Lihat</a>
                @else
                    -
                @endif
            </p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-3">
            <h5>Ringkasan</h5>
            <p><strong>Jumlah Produk:</strong> {{ $order->product_qty }}</p>
            <p><strong>Subtotal:</strong> Rp {{ number_format($order->subtotal,0,',','.') }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>

            <a href="{{ route('admin.orders.edit',$order->id) }}" class="btn btn-warning">Ubah Status</a>
        </div>
    </div>
</div>

@if($userOrder && $userOrder->items->count())
<div class="card mt-3 p-3">
    <h5>Item Pesanan (User)</h5>
    <table class="table">
        <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
        <tbody>
            @foreach($userOrder->items as $it)
            <tr>
                <td>{{ $it->nama_produk }}</td>
                <td>{{ $it->jumlah }}</td>
                <td>Rp {{ number_format($it->harga_satuan,0,',','.') }}</td>
                <td>Rp {{ number_format($it->subtotal,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
