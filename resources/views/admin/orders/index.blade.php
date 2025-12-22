@extends('admin.layouts.admin')
@section('title','Kelola Order')

@section('content')
<div class="container-fluid px-4">

<h3 class="mb-4 text-success fw-bold">KELOLA ORDER</h3>

<form method="GET" class="mb-3 d-flex gap-2">
    <select name="status" class="form-select w-auto">
        <option value="">Semua Status</option>
        @foreach(['pending','diproses','dikirim','selesai','dibatalkan'] as $st)
            <option value="{{ $st }}" {{ request('status')==$st?'selected':'' }}>
                {{ ucfirst($st) }}
            </option>
        @endforeach
    </select>
    <button class="btn btn-outline-success">Filter</button>
</form>

<div class="card shadow-sm">
<div class="table-responsive">
<table class="table table-bordered align-middle">
<thead class="table-light">
<tr>
    <th>ID</th>
    <th>Status</th>
    <th>Item</th>
    <th>Customer</th>
    <th>Produk</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
@forelse($orders as $order)
<tr>
    <td>{{ $order->id_pesanan }}</td>

    <td>
        <span class="badge bg-{{
            $order->status=='pending' ? 'secondary' :
            ($order->status=='diproses' ? 'warning' :
            ($order->status=='dikirim' ? 'info' :
            ($order->status=='selesai' ? 'success' : 'danger')))
        }}">
            {{ ucfirst($order->status) }}
        </span>
    </td>
    <td class="text-center">
        {{ $order->items->sum('kuantitas') }}
    </td>

    <td>{{ $order->nama_penerima ?? '-' }}</td>

    <td>
        @foreach($order->items as $item)
            {{ optional($item->produkUkuran->produk)->nama}}
            (x{{ $item->kuantitas }})<br>
        @endforeach
    </td>

    <td>
        Rp {{ number_format($order->total_harga,0,',','.') }}
    </td>

    <td class="text-center">
        <a href="{{ route('admin.orders.show',$order->id_pesanan) }}"
           class="btn btn-sm btn-outline-success">✏️</a>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center text-muted">
        Belum ada pesanan
    </td>
</tr>
@endforelse
</tbody>
</table>
</div>

<div class="p-3">
    {{ $orders->links() }}
</div>
</div>
</div>
@endsection
