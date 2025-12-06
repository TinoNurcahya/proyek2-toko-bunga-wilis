@extends('layouts.admin')
@section('title','Ubah Status Pesanan')

@section('content')
<h3>Ubah Status Pesanan {{ $order->order_code }}</h3>

<form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="MENUNGGU PEMBAYARAN" {{ $order->status=='MENUNGGU PEMBAYARAN'?'selected':'' }}>Menunggu Pembayaran</option>
            <option value="DIKEMAS" {{ $order->status=='DIKEMAS'?'selected':'' }}>Dikemas</option>
            <option value="DIKIRIM" {{ $order->status=='DIKIRIM'?'selected':'' }}>Dikirim</option>
            <option value="SAMPAI TUJUAN" {{ $order->status=='SAMPAI TUJUAN'?'selected':'' }}>Sampai Tujuan</option>
            <option value="SELESAI" {{ $order->status=='SELESAI'?'selected':'' }}>Selesai</option>
            <option value="DIBATALKAN" {{ $order->status=='DIBATALKAN'?'selected':'' }}>Dibatalkan</option>
        </select>
    </div>

    <div class="form-group">
        <label>No. Resi (opsional)</label>
        <input type="text" name="resi" value="{{ $order->resi }}" class="form-control">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
@endsection
