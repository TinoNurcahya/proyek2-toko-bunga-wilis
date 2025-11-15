@extends('layouts.app')

@section('content')
<div class="container my-5">

  {{-- Tombol kembali --}}
  <a href="{{ url()->previous() }}" class="btn btn-outline-success mb-4">
    ← Kembali ke Produk
  </a>

  {{-- Bagian detail produk --}}
  <div class="row g-5">
    {{-- Gambar produk --}}
    <div class="col-md-5 text-center">
      <img src="{{ asset($produk->foto_utama) }}" 
           alt="{{ $produk->nama }}" 
           class="img-fluid rounded shadow"> 
    </div>

    {{-- Info produk --}}
    <div class="col-md-7">
      <h2 class="fw-bold">{{ $produk->nama }}</h2>
      <p><span class="badge bg-success">{{ $produk->kategori?->nama ?? '-' }}</span></p>

      {{-- Harga (ambil dari accessor harga_terendah dan tertinggi) --}}
      <h4 class="text-success fw-bold mb-3">
        @if ($produk->harga_terendah && $produk->harga_tertinggi && $produk->harga_terendah != $produk->harga_tertinggi)
          Rp {{ number_format($produk->harga_terendah, 0, ',', '.') }} - Rp {{ number_format($produk->harga_tertinggi, 0, ',', '.') }}
        @elseif($produk->harga_terendah)
          Rp {{ number_format($produk->harga_terendah, 0, ',', '.') }}
        @else
          Harga tidak tersedia
        @endif
      </h4>

      <p><strong>Rating:</strong> ⭐ {{ number_format($produk->rating, 1) }} ({{ $produk->jumlah_rating }} ulasan)</p>
      <p><strong>Terjual:</strong> {{ $produk->terjual_formatted }}</p>

      {{-- Jika produk punya detail tanaman --}}
      @if($produk->detailTanaman)
        <p><strong>Asal:</strong> {{ $produk->detailTanaman->asal_tanaman ?? '-' }}</p>
        <p><strong>Ukuran:</strong> {{ $produk->detailTanaman->ukuran_detail ?? '-' }}</p>
        <p><strong>Perawatan:</strong> {{ $produk->detailTanaman->perawatan ?? '-' }}</p>
      @endif

      {{-- Kuantitas dan subtotal --}}
      <div class="d-flex align-items-center mb-3">
        <button class="btn btn-outline-secondary" onclick="changeQty(-1)">−</button>
        <div id="qty" class="mx-3 fs-5">1</div>
        <button class="btn btn-outline-secondary" onclick="changeQty(1)">+</button>
        <span class="ms-3 text-muted">Stok: {{ $produk->produkUkuran->sum('stok') ?? 0 }}</span>
      </div>

      <div class="fs-5 mb-3">
        Subtotal: <span id="subtotal" class="text-success fw-bold">
          Rp {{ number_format($produk->harga_terendah ?? 0, 0, ',', '.') }}
        </span>
      </div>

      <div class="d-flex gap-3 mb-4">
        <button class="btn btn-success flex-fill">Masukkan ke Keranjang</button>
        <button class="btn btn-outline-success flex-fill">Beli Sekarang</button>
      </div>

      {{-- Tabs Deskripsi --}}
      <ul class="nav nav-tabs" id="productTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button">Deskripsi</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button">Detail Tanaman</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="care-tab" data-bs-toggle="tab" data-bs-target="#care" type="button">Perawatan</button>
        </li>
      </ul>

      <div class="tab-content border border-top-0 p-3 rounded-bottom" id="productTabContent">
        <div class="tab-pane fade show active" id="desc">
          <p>{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>
        <div class="tab-pane fade" id="detail">
          @if($produk->detailTanaman)
            <p><strong>Asal:</strong> {{ $produk->detailTanaman->asal_tanaman ?? '-' }}</p>
            <p><strong>Ukuran:</strong> {{ $produk->detailTanaman->ukuran_detail ?? '-' }}</p>
          @else
            <p class="text-muted">Detail tanaman belum tersedia.</p>
          @endif
        </div>
<div class="tab-pane fade" id="care">
  @if($produk->petunjukPerawatan)
    <p><strong>Penyiraman:</strong> {{ $produk->petunjukPerawatan->penyiraman ?? '-' }}</p>
    <p><strong>Cahaya:</strong> {{ $produk->petunjukPerawatan->cahaya ?? '-' }}</p>
    <p><strong>Suhu & Kelembapan:</strong> {{ $produk->petunjukPerawatan->suhu_dan_kelembapan ?? '-' }}</p>
  @else
    <p class="text-muted">Belum ada petunjuk perawatan untuk produk ini.</p>
  @endif
</div>

      </div>
    </div>
  </div>

  {{-- Produk Terkait --}}
  <div class="mt-5">
    <h3>Kamu Mungkin Juga Suka</h3>
    <div class="row mt-3">
      @foreach($relatedProducts ?? [] as $related)
        <div class="col-md-3 col-6 mb-4">
          <div class="card h-100">
            <img src="{{ asset($related->foto_utama) }}" class="card-img-top" alt="{{ $related->nama }}">
            <div class="card-body text-center">
              <h6 class="fw-bold">{{ $related->nama }}</h6>
              <p class="text-success fw-semibold mb-1">
                Rp {{ number_format($related->harga_terendah ?? 0, 0, ',', '.') }}
              </p>
              <a href="{{ route('produk.detail', $related->id_produk) }}" class="btn btn-sm btn-outline-success">
                Lihat Produk
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <footer class="text-center mt-5 text-muted">
    © 2025 Wilis Garden. All rights reserved.
  </footer>
</div>

{{-- Script kecil untuk update jumlah & subtotal --}}
<script>
  let qty = 1;
  const price = {{ $produk->harga_terendah ?? 0 }};

  function changeQty(change) {
    qty = Math.max(1, qty + change);
    document.getElementById('qty').textContent = qty;
    document.getElementById('subtotal').textContent = 
      'Rp ' + (qty * price).toLocaleString('id-ID');
  }
</script>
@endsection
