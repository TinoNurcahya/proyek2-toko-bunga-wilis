<div>
  <!-- Header Checkout -->
  <div class="d-none d-md-block mb-4 mt-4">
    <div class="d-flex justify-content-between text-center">
      <div class="flex-fill position-relative">
        <div class="step-icon bg-success text-white position-relative z-1">
          <i class="fas fa-shopping-cart fa-fw"></i>
        </div>
        <p class="fw-bold small mb-0 fraunces">Data pelanggan</p>
        <small class="text-success montserrat fw-medium">Langkah 1</small>
      </div>

      <div class="flex-fill position-relative">
        <div class="step-line z-0"></div>
        <div class="step-icon bg-warning text-white position-relative z-1">
          <i class="fas fa-user-circle fa-fw"></i>
        </div>
        <p class="fw-semibold small mb-0 fraunces">Pembayaran</p>
        <small class="text-muted montserrat">Langkah 2</small>
      </div>

      <div class="flex-fill position-relative">
        <div class="step-line z-0"></div>
        <div class="step-icon bg-warning text-white position-relative z-1">
          <i class="fas fa-user-circle fa-fw"></i>
        </div>
        <p class="fw-semibold small mb-0 fraunces">Konfirmasi Berhasil</p>
        <small class="text-muted montserrat">Langkah 3</small>
      </div>
    </div>
  </div>

  {{-- Mobile Header --}}
  <div class="d-md-none mb-3 mt-3">
    <div class="d-flex align-items-center">
      <a href="{{ route('profile.keranjang') }}" class="btn btn-green text-light btn-md me-3">
        <i class="fas fa-arrow-left"></i>
      </a>
      <div>
        <h5 class="fw-bold mb-0 fraunces">Data pelanggan</h5>
        <small class="text-muted montserrat">Langkah <strong>1</strong> dari 3</small>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="py-4 mt-3">
    <div class="container">
      @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="row g-4">
        <!-- Informasi Pelanggan -->
        <section class="col-md-7 montserrat">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <h5 class="card-title mb-4">
                <i class="fa-regular fa-user me-2"></i>Informasi pelanggan
              </h5>
              <form wire:submit.prevent="prosesCheckout">
                <div class="mb-3">
                  <label class="form-label fw-medium">
                    Nama <span class="text-danger"><span class="text-danger">*</span></span>
                  </label>
                  <input type="text" class="form-control form-control-md p-2" placeholder="Masukkan nama lengkap"
                    wire:model="nama" required>
                  @error('nama')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label fw-medium mb-1">Alamat email <span class="text-danger">*</span></label>
                    <input id="email" name="email" type="email" class="form-control form-control-md p-2"
                      placeholder="Masukkan email aktif" wire:model="email" required>
                    @error('email')
                      <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-medium">Nomor telepon <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control form-control-md p-2" placeholder="08xxxxxxxxxx"
                      wire:model="telepon" required>
                    @error('telepon')
                      <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-medium">Alamat <span class="text-danger">*</span></label>
                  <textarea class="form-control form-control-md p-2" rows="3" placeholder="Masukkan alamat lengkap"
                    wire:model="alamat" required></textarea>
                  @error('alamat')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row mb-4">
                  <div class="col-md-6">
                    <label class="form-label fw-medium">Kota <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md p-2" placeholder="Masukkan kota"
                      wire:model="kota" required>
                    @error('kota')
                      <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-medium">Kode pos <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md p-2" placeholder="Masukkan kode pos"
                      wire:model="kode_pos" required>
                    @error('kode_pos')
                      <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <button type="submit" class="btn btn-green btn-sm w-100 p-3 text-light fw-semibold border rounded"
                  wire:loading.attr="disabled">
                  <span wire:loading.remove>
                    Lanjutkan ke pembayaran
                  </span>
                  <span wire:loading class="text-dark">
                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                    Memproses...
                  </span>
                </button>
              </form>
            </div>
          </div>
        </section>

        <!-- Ringkasan Pesanan -->
        <section class="col-md-5 montserrat">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
              <h5 class="card-title mb-4">Ringkasan Pesanan</h5>

              <div class="d-flex flex-column gap-3 mb-4" style="max-height: 300px; overflow-y: auto;">
                @forelse($keranjangItems as $item)
                  @php
                    $produk = $item->produkUkuran->produk ?? null;
                    $ukuran = $item->produkUkuran->ukuran ?? null;
                    $harga = $item->produkUkuran->harga ?? 0;
                    $stok = $item->produkUkuran->stok ?? 0;
                  @endphp

                  <div
                    class="d-flex align-items-start gap-3 p-3 border rounded 
                                              {{ $stok < $item->jumlah ? 'border-danger bg-danger bg-opacity-10' : '' }}">
                    <div class="flex-shrink-0">
                      <img src="{{ asset($produk->foto_utama ?? 'images/default/default-product.png') }}"
                        alt="{{ $produk->nama ?? 'Produk' }}" class="rounded"
                        style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 fw-medium {{ $stok < $item->jumlah ? 'text-danger' : '' }}">
                        {{ $produk->nama ?? 'Produk tidak tersedia' }}
                      </h6>
                      @if ($ukuran)
                        <p class="mb-1 text-muted small">Ukuran: {{ $ukuran->nama_ukuran }}</p>
                      @endif
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <span class="text-muted">Qty: {{ $item->jumlah }}</span>
                          @if ($stok < $item->jumlah)
                            <span class="badge bg-danger ms-2">Stok tidak mencukupi</span>
                          @endif
                        </div>
                        <span class="fw-bold">
                          Rp {{ number_format($harga * $item->jumlah, 0, ',', '.') }}
                        </span>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="text-center py-4">
                    <i class="fa fa-shopping-cart display-5 text-muted mb-3"></i>
                    <p class="text-muted mb-3">Tidak ada item untuk checkout</p>
                    <a href="{{ route('profile.keranjang') }}" class="btn btn-outline-primary">
                      Kembali ke Keranjang
                    </a>
                  </div>
                @endforelse
              </div>

              @if (count($keranjangItems) > 0)
                <div class="border-top pt-3">
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Sub-total</span>
                    <span class="fw-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Pengiriman</span>
                    <span class="text-success fw-medium">Gratis</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Pajak (11%)</span>
                    <span class="fw-medium">Rp {{ number_format($pajak, 0, ',', '.') }}</span>
                  </div>

                  <div class="border-top my-3"></div>

                  <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold text-success fs-5">
                      Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                  </div>

                  <div class="alert alert-warning mt-3 small">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Pastikan semua stok produk mencukupi sebelum melanjutkan pembayaran.
                  </div>
                </div>
              @endif
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
