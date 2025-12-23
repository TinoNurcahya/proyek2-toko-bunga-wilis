@extends('admin.layouts.admin')
@section('title','Detail Pesanan')
@section('page-title','Detail Pesanan')

@section('content')

<div class="container-fluid px-4">

    <a href="{{ route('admin.orders') }}" class="btn btn-secondary mb-3">
        ← Kembali ke Kelola Order
    </a>

    <h3 class="mb-4">
        Detail Pesanan
        <span class="text-muted">#{{ $order->kode_pesanan }}</span>
    </h3>

    <div class="row">

        {{-- INFORMASI CUSTOMER --}}
        <div class="col-lg-6 mb-3">
            <div class="card h-100">
                <div class="card-header">Informasi Customer</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <small>Nama</small><br>{{ $order->nama_penerima ?? '-' }}
                    </li>
                    <li class="list-group-item">
                        <small>Telepon</small><br>{{ $order->telepon_penerima ?? '-' }}
                    </li>
                    <li class="list-group-item">
                        <small>Alamat</small><br>{{ $order->alamat_pengiriman ?? '-' }}
                    </li>
                    <li class="list-group-item">
                        <small>Metode Pembayaran</small><br>{{ ucfirst($order->metode_pembayaran ?? '-') }}
                    </li>
                </ul>
            </div>
        </div>

        {{-- RINGKASAN --}}
        <div class="col-lg-6 mb-3">
            <div class="card h-100">
                <div class="card-header">Ringkasan Pesanan</div>
                <div class="card-body">

                    @php
                        $ppn_persen = 11;
                        $subtotal = $order->subtotal;
                        $ppn = $subtotal * ($ppn_persen / 100);
                        $grand_total = $subtotal + $ppn;

                        $statusColor = match($order->status) {
                            'menunggu' => 'secondary',
                            'diproses' => 'warning',
                            'dikirim' => 'info',
                            'selesai' => 'success',
                            'dibatalkan' => 'danger',
                            default => 'secondary',
                        };
                    @endphp

                    <div class="mb-2">
                        <small>Subtotal</small><br>
                        Rp {{ number_format($subtotal,0,',','.') }}
                    </div>

                    <div class="mb-2">
                        <small>PPN ({{ $ppn_persen }}%)</small><br>
                        Rp {{ number_format($ppn,0,',','.') }}
                    </div>

                    <hr>

                    <div class="mb-3">
                        <small>Total Bayar</small><br>
                        <strong class="text-success fs-5">
                            Rp {{ number_format($grand_total,0,',','.') }}
                        </strong>
                    </div>

                    <p class="mb-3">
                        <small>Status Saat Ini</small><br>
                        <span class="badge bg-{{ $statusColor }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>

                    @php
                        $locked = in_array($order->status, ['selesai','dibatalkan']);
                    @endphp

                    <form method="POST" action="{{ route('admin.orders.status', $order->id_pesanan) }}">
                        @csrf
                        <label class="fw-bold">Ubah Status</label>
                        <select name="status"
                                class="form-select mt-1"
                                {{ $locked ? 'disabled' : '' }}
                                onchange="confirm('Yakin ubah status pesanan?') && this.form.submit()">
                            @foreach(['menunggu','diproses','dikirim','selesai','dibatalkan'] as $st)
                                <option value="{{ $st }}" {{ $order->status == $st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>

                        @if($locked)
                            <small class="text-muted">Status ini bersifat final</small>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- INFORMASI TRANSFER --}}
    @if($order->metode_pembayaran === 'transfer')
    <div class="card mb-3">
        <div class="card-header">Informasi Transfer</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <small>Bank</small><br>{{ $order->bank_tujuan ?? 'BCA' }}
                </div>
                <div class="col-md-4">
                    <small>VA Number</small><br>{{ $order->va_number ?? '-' }}
                </div>
                <div class="col-md-4">
                    <small>Atas Nama</small><br>{{ $order->nama_rekening ?? '-' }}
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ITEM PESANAN --}}
    <div class="card">
        <div class="card-header">Item Pesanan</div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th width="100">Ukuran</th>
                        <th width="80" class="text-center">Qty</th>
                        <th width="150">Harga</th>
                        <th width="150">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($order->items as $item)
                    <tr>
                        <td>{{ optional($item->produkUkuran->produk)->nama ?? '-' }}</td>
                        <td>{{ optional($item->produkUkuran->ukuran)->nama_ukuran ?? '-' }}</td>
                        <td class="text-center">{{ $item->kuantitas }}</td>
                        <td>Rp {{ number_format($item->harga_satuan,0,',','.') }}</td>
                        <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Item tidak ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
