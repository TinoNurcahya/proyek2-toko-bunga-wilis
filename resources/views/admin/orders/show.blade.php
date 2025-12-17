@extends('admin.layouts.admin')
@section('title','Detail Pesanan')

@section('content')
<div class="container-fluid px-4">

    {{-- BACK --}}
    <a href="{{ route('admin.orders') }}" class="btn btn-secondary mb-3">
        ← Kembali ke Kelola Order
    </a>

    <h3 class="mb-4">
        Detail Pesanan
        <span class="text-muted">#{{ $order->kode_pesanan }}</span>
    </h3>

    {{-- INFO CUSTOMER + RINGKASAN --}}
    <div class="row">

        {{-- CUSTOMER --}}
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm p-3 h-100">
                <h5 class="mb-3">Informasi Customer</h5>

                <p><strong>Nama</strong><br>{{ $order->nama_penerima ?? '-' }}</p>
                <p><strong>Telepon</strong><br>{{ $order->telepon_penerima ?? '-' }}</p>
                <p><strong>Alamat</strong><br>{{ $order->alamat_pengiriman ?? '-' }}</p>
                <p><strong>Metode Pembayaran</strong><br>
                    {{ ucfirst($order->metode_pembayaran ?? '-') }}
                </p>
            </div>
        </div>

        {{-- RINGKASAN --}}
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm p-3 h-100">
                <h5 class="mb-3">Ringkasan Pesanan</h5>

                <p>
                    <strong>Total Harga</strong><br>
                    <span class="fw-bold text-success">
                        Rp {{ number_format($order->total_harga,0,',','.') }}
                    </span>
                </p>

                <p>
                    <strong>Status Saat Ini</strong><br>
                    <span class="badge
                        @if($order->status=='pending') bg-secondary
                        @elseif($order->status=='diproses') bg-warning
                        @elseif($order->status=='dikirim') bg-info
                        @elseif($order->status=='selesai') bg-success
                        @else bg-danger
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>

                {{-- FORM UPDATE STATUS --}}
                <form method="POST"
                      action="{{ route('admin.orders.status', $order->id_pesanan) }}">
                    @csrf

                    <label class="fw-bold mt-2">Ubah Status</label>
                    <select name="status"
                            class="form-select w-75"
                            onchange="this.form.submit()">
                        @foreach(['pending','diproses','dikirim','selesai','dibatalkan'] as $st)
                            <option value="{{ $st }}"
                                {{ $order->status==$st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

    </div>

    {{-- RESI --}}
    <div class="card shadow-sm p-3 mb-3">
        <h5 class="mb-3">Informasi Pengiriman</h5>

        <form method="POST"
              action="{{ route('admin.orders.resi', $order->id_pesanan) }}">
            @csrf

            <label>No Resi</label>
            <input type="text"
                   name="no_resi"
                   value="{{ $order->no_resi }}"
                   class="form-control w-50 mb-2"
                   placeholder="Masukkan nomor resi">

            <button class="btn btn-success">
                Simpan Resi
            </button>
        </form>
    </div>

    {{-- ITEM PESANAN --}}
    <div class="card shadow-sm p-3">
        <h5 class="mb-3">Item Pesanan</h5>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th width="80">Qty</th>
                        <th width="150">Harga</th>
                        <th width="150">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->items as $item)
                    <tr>
                        <td>
                            {{ $item->produkUkuran->produk->nama_produk ?? '-' }}
                        </td>
                        <td class="text-center">
                            {{ $item->kuantitas }}
                        </td>
                        <td>
                            Rp {{ number_format($item->harga_satuan,0,',','.') }}
                        </td>
                        <td>
                            Rp {{ number_format($item->subtotal,0,',','.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Item pesanan tidak ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
