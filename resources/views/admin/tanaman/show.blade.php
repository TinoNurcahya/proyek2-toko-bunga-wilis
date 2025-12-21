@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-3">Detail Tanaman</h4>

    {{-- ================= DATA UTAMA ================= --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-start">

                {{-- FOTO UTAMA --}}
                <div class="col-md-4 text-center">
                    @if($produk->foto_utama)
                        <img src="{{ asset($produk->foto_utama) }}"
                             class="img-fluid rounded border mb-2">
                    @else
                        <div class="text-muted">Tidak ada foto</div>
                    @endif
                    <small class="text-muted d-block">Foto Utama</small>
                </div>

                {{-- INFORMASI --}}
                <div class="col-md-8">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th width="200">Nama Tanaman</th>
                            <td>{{ $produk->nama }}</td>
                        </tr>
                        <tr>
                            <th>Nama Ilmiah</th>
                            <td><em>{{ $produk->detailTanaman->nama_ilmiah ?? '-' }}</em></td>
                        </tr>
                        <tr>
                            <th>Asal Tanaman</th>
                            <td>{{ $produk->detailTanaman->asal_tanaman ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Ukuran Tanaman</th>
                            <td>{{ $produk->detailTanaman->ukuran_detail ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $produk->deskripsi }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('admin.tanaman') }}"
                       class="btn btn-secondary mt-3">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= HARGA & STOK ================= --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light fw-bold">
            Harga & Stok
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ukuran</th>
                        <th width="200">Harga</th>
                        <th width="120">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk->produkUkuran as $item)
                        <tr>
                            <td>{{ $item->ukuran->nama_ukuran }}</td>
                            <td>Rp {{ number_format($item->harga) }}</td>
                            <td>{{ $item->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data harga & stok
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= PETUNJUK PERAWATAN ================= --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light fw-bold">
            Petunjuk Perawatan
        </div>
        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3 h-100">
                        <h6 class="fw-bold mb-2">💧 Penyiraman</h6>
                        <p class="mb-0">
                            {{ $produk->petunjukPerawatan->penyiraman ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3 h-100">
                        <h6 class="fw-bold mb-2">☀️ Cahaya</h6>
                        <p class="mb-0">
                            {{ $produk->petunjukPerawatan->cahaya ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3 h-100">
                        <h6 class="fw-bold mb-2">🌡️ Suhu & Kelembapan</h6>
                        <p class="mb-0">
                            {{ $produk->petunjukPerawatan->suhu ?? '-' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= GALLERY FOTO ================= --}}
    @if ($produk->fotoProduk->count())
    <div class="card shadow-sm">
        <div class="card-header bg-light fw-bold">
            Gallery Foto
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($produk->fotoProduk as $foto)
                <div class="col-md-3 mb-3">
                    <img src="{{ asset($foto->foto) }}"
                         class="img-fluid rounded border">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
