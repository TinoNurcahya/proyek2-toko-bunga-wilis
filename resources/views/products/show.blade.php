@extends('layouts.app')

@section('title', $product->name)

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
    <img src="{{ asset($product->image) }}" 
     alt="{{ $product->name }}" 
     class="img-fluid rounded shadow"> 
    </div>

    {{-- Info produk --}}
    <div class="col-md-7">
      <h2 class="fw-bold">{{ $product->name }}</h2>
      <p class="text-muted fst-italic">{{ $product->scientific_name }}</p>
      <p><span class="badge bg-success">{{ $product->category?->name ?? '-' }}</span></p>

      <h4 class="text-success fw-bold mb-3">
        Rp {{ number_format($product->price, 0, ',', '.') }}
      </h4>

      <p><strong>Asal:</strong> {{ $product->origin }}</p>
      <p><strong>Ukuran:</strong> {{ $product->size }}</p>

      <div class="d-flex align-items-center mb-3">
        <button class="btn btn-outline-secondary" onclick="changeQty(-1)">−</button>
        <div id="qty" class="mx-3 fs-5">1</div>
        <button class="btn btn-outline-secondary" onclick="changeQty(1)">+</button>
        <span class="ms-3 text-muted">Stok: {{ $product->stock }}</span>
      </div>

      <div class="fs-5 mb-3">
        Subtotal: <span id="subtotal" class="text-success fw-bold">
          Rp {{ number_format($product->price, 0, ',', '.') }}
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
          <p>{{ $product->description }}</p>
        </div>
        <div class="tab-pane fade" id="detail">
          <p><strong>Asal:</strong> {{ $product->origin }}</p>
          <p><strong>Ukuran:</strong> {{ $product->size }}</p>
        </div>
        <div class="tab-pane fade" id="care">
          <p>{!! nl2br(e($product->care_instructions)) !!}</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Ulasan Produk --}}
  <div class="mt-5">
    <h3>Penilaian Produk</h3>
    <p><strong>{{ $product->rating }}★</strong> dari {{ $product->reviews->count() }} ulasan</p>

    @forelse($product->reviews as $review)
      <div class="card mb-3">
        <div class="card-body">
          <h6 class="fw-bold mb-1">{{ $review->user_name }}</h6>
          <small class="text-muted">{{ \Carbon\Carbon::parse($review->review_date)->translatedFormat('d F Y') }}</small>
          <p class="mt-2 mb-0">{{ $review->comment }}</p>
        </div>
      </div>
    @empty
      <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
    @endforelse
  </div>

  {{-- Produk Terkait --}}
  <div class="mt-5">
    <h3>Kamu Mungkin Juga Suka</h3>
    <div class="row mt-3">
      @foreach($relatedProducts as $related)
        <div class="col-md-3 col-6 mb-4">
          <div class="card h-100">
            <img src="{{ asset($related->image) }}" class="card-img-top" alt="{{ $related->name }}">
            <div class="card-body text-center">
              <h6 class="fw-bold">{{ $related->name }}</h6>
              <p class="text-success fw-semibold mb-1">
                Rp {{ number_format($related->price, 0, ',', '.') }}
              </p>
              <a href="{{ route('products.show', $related->slug) }}" class="btn btn-sm btn-outline-success">
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
  const price = {{ $product->price }};

  function changeQty(change) {
    qty = Math.max(1, qty + change);
    document.getElementById('qty').textContent = qty;
    document.getElementById('subtotal').textContent = 
      'Rp ' + (qty * price).toLocaleString('id-ID');
  }
</script>
@endsection
