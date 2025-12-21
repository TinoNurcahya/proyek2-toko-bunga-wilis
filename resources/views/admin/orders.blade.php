@extends('admin.layout')

@section('title', 'Kelola Order')
@section('page-title', 'Kelola Order')

@section('content')

<style>
    .page-title {
        font-size: 30px;
        font-weight: 800;
        color: #1B5E20;
    }

    .badge-status {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #fff;
    }

    .status-menunggu { background: #3B82F6; }
    .status-diproses { background: #FACC15; color: #000; }
    .status-dikirim { background: #22C55E; }
    .status-gagal { background: #EF4444; }
    .status-selesai { background: #A855F7; }
</style>

<h2 class="page-title mb-4">KELOLA ORDER</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID PESANAN</th>
                    <th>STATUS</th>
                    <th>ITEM</th>
                    <th>NAMA CUSTOMER</th>
                    <th>PRODUK</th>
                    <th>TOTAL HARGA</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            @foreach ($orders as $order)

                @php
                    $statusClass = [
                        'menunggu' => 'status-menunggu',
                        'diproses' => 'status-diproses',
                        'dikirim'   => 'status-dikirim',
                        'gagal'     => 'status-gagal',
                        'selesai'   => 'status-selesai',
                    ];
                @endphp

                <tr>

                    <td>{{ $order->id_pesanan }}</td>

                    <td>
                        <span class="badge-status {{ $statusClass[$order->status] ?? 'status-menunggu' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>

                    {{-- TOTAL ITEM --}}
                    <td>{{ $order->items->sum('kuantitas') }}</td>

                    {{-- USER --}}
                    <td>{{ $order->user->name ?? '-' }}</td>

                    {{-- PRODUK LIST --}}
                    <td>
                        @foreach ($order->items as $item)
                            {{ $item->produkUkuran->produk->nama_produk ?? '-' }}
                            (x{{ $item->kuantitas }}) <br>
                        @endforeach
                    </td>

                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>

                    <td class="text-end">
                        <a href="{{ route('admin.orders.show', $order->id_pesanan) }}" 
                           class="btn btn-sm btn-outline-success">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>

                </tr>

            @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
