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
            @if ($produk->foto_utama)
              <img src="{{ asset($produk->foto_utama) }}" class="img-fluid rounded border mb-2"
                style="max-height: 300px; object-fit: cover;">
            @else
              <div class="text-muted">Tidak ada foto</div>
            @endif
            <small class="text-muted d-block">Foto Utama</small>
          </div>

          {{-- INFORMASI --}}
          <div class="col-md-8">
            <table class="table table-bordered mb-0">
              <tr>
                <th width="200">ID Produk</th>
                <td>#{{ $produk->id_produk }}</td>
              </tr>
              <tr>
                <th>Nama Tanaman</th>
                <td>{{ $produk->nama }}</td>
              </tr>
              <tr>
                <th>Kategori</th>
                <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
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
                <th>Ukuran Detail</th>
                <td>{{ $produk->detailTanaman->ukuran_detail ?? '-' }}</td>
              </tr>
              <tr>
                <th>Terjual</th>
                <td>{{ $produk->terjual ?? 0 }} item</td>
              </tr>
              <tr>
                <th>Rating</th>
                <td>
                  @if ($produk->jumlah_rating > 0)
                    {{ number_format($produk->rating, 1) }} ⭐
                    ({{ $produk->jumlah_rating }} ulasan)
                  @else
                    Belum ada rating
                  @endif
                </td>
              </tr>
              <tr>
                <th>Deskripsi</th>
                <td style="white-space: pre-wrap;">{{ $produk->deskripsi }}</td>
              </tr>
            </table>

            <div class="d-flex gap-2 mt-3">
              <a href="{{ route('admin.tanaman.edit', $produk->id_produk) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit
              </a>
              <a href="{{ route('admin.tanaman') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
              </a>
              <form action="{{ route('admin.tanaman.destroy', $produk->id_produk) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Hapus tanaman ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                  <i class="fas fa-trash me-1"></i> Hapus
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- ================= HARGA & STOK ================= --}}
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
        <span>Harga & Stok</span>
        <span class="badge bg-primary">{{ $produk->produkUkuran->count() }} Ukuran</span>
      </div>
      <div class="card-body">
        @if ($produk->produkUkuran->count() > 0)
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
              <thead class="table-light">
                <tr>
                  <th>Ukuran</th>
                  <th width="200">Harga (Rp)</th>
                  <th width="120">Stok</th>
                  <th width="150">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @php $total_stok = 0; @endphp
                @foreach ($produk->produkUkuran as $item)
                  @php
                    $subtotal = $item->harga * $item->stok;
                    $total_stok += $item->stok;
                  @endphp
                  <tr>
                    <td>{{ $item->ukuran->nama_ukuran ?? 'Ukuran ' . $item->id_ukuran }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($item->stok, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                  </tr>
                @endforeach
                <tr class="table-light fw-bold">
                  <td colspan="2" class="text-end">TOTAL:</td>
                  <td class="text-center">{{ number_format($total_stok, 0, ',', '.') }}</td>
                  <td>Rp
                    {{ number_format(
                        $produk->produkUkuran->sum(function ($item) {
                            return $item->harga * $item->stok;
                        }),
                        0,
                        ',',
                        '.',
                    ) }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        @else
          <div class="alert alert-warning mb-0">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Belum ada data harga & stok.
            <a href="{{ route('admin.tanaman.edit', $produk->id_produk) }}">Tambahkan di sini</a>.
          </div>
        @endif
      </div>
    </div>

    {{-- ================= PETUNJUK PERAWATAN ================= --}}
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-light fw-bold">
        Petunjuk Perawatan
      </div>
      <div class="card-body">
        @if ($produk->petunjukPerawatan)
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="border rounded p-3 h-100 bg-light">
                <h6 class="fw-bold mb-2">
                  <i class="fas fa-tint text-primary me-2"></i>Penyiraman
                </h6>
                <div class="mt-2" style="white-space: pre-wrap;">
                  {{ $produk->petunjukPerawatan->penyiraman ?? 'Belum diatur' }}
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="border rounded p-3 h-100 bg-light">
                <h6 class="fw-bold mb-2">
                  <i class="fas fa-sun text-warning me-2"></i>Cahaya
                </h6>
                <div class="mt-2" style="white-space: pre-wrap;">
                  {{ $produk->petunjukPerawatan->cahaya ?? 'Belum diatur' }}
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="border rounded p-3 h-100 bg-light">
                <h6 class="fw-bold mb-2">
                  <i class="fas fa-thermometer-half text-danger me-2"></i>Suhu & Kelembapan
                </h6>
                <div class="mt-2" style="white-space: pre-wrap;">
                  {{ $produk->petunjukPerawatan->suhu_dan_kelembapan ?? 'Belum diatur' }}
                </div>
              </div>
            </div>
          </div>
        @else
          <div class="alert alert-info mb-0">
            <i class="fas fa-info-circle me-2"></i>
            Belum ada petunjuk perawatan.
            <a href="{{ route('admin.tanaman.edit', $produk->id_produk) }}">Tambahkan di sini</a>.
          </div>
        @endif
      </div>
    </div>

    {{-- ================= GALLERY FOTO ================= --}}
    @if ($produk->fotoProduk->count() > 0)
      <div class="card shadow-sm">
        <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
          <span>Gallery Foto</span>
          <span class="badge bg-primary">{{ $produk->fotoProduk->count() }} Foto</span>
        </div>
        <div class="card-body">
          <div class="row">
            @foreach ($produk->fotoProduk as $index => $foto)
              <div class="col-md-3 mb-3">
                <div class="position-relative">
                  <img src="{{ asset($foto->foto) }}" class="img-fluid rounded border"
                    style="height: 200px; width: 100%; object-fit: cover;">
                  <span class="position-absolute top-0 start-0 badge bg-dark m-2">
                    #{{ $index + 1 }}
                  </span>
                </div>
                <div class="mt-1 text-center small text-muted">
                  {{ basename($foto->foto) }}
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif

  </div>

  <style>
    .table th {
      background-color: #f8f9fa;
    }

    .card-header {
      background-color: #f8f9fa !important;
    }

    .bg-light {
      background-color: #f8f9fa !important;
    }
  </style>
@endsection
