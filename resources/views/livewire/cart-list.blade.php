<div>
  <!-- Header Mobile -->
  <div class="mb-4">
    <div class="d-flex justify-content-between align-items-start mb-2">
      <div>
        <h2 class="h5 fw-bold text-dark mb-1">{{ __('Keranjang Belanja') }}</h2>
        <p class="small text-muted mb-0 d-none d-md-block">
          {{ __('Kelola produk dalam keranjang belanja Anda.') }}
        </p>
      </div>
      @if ($cartItems->count() > 0)
        <div class="text-end">
          <span class="badge bg-success mb-1">
            {{ $cartItems->count() }} item
          </span>
          <div class="fw-bold text-success small">
            @if ($this->selectedItemsCount > 0)
              Total Terpilih: Rp {{ number_format($this->selectedTotalPrice, 0, ',', '.') }}
            @else
              Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}
            @endif
          </div>
        </div>
      @endif
    </div>
    <p class="small text-muted mb-0 d-md-none">
      {{ __('Kelola produk dalam keranjang belanja Anda.') }}
    </p>
  </div>

  @if ($cartItems->count() > 0)
    <!-- Selection Controls -->
    <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
      <div class="form-check">
        <input class="form-check-input border-success" type="checkbox" wire:model.live="selectAll" id="selectAll">
        <label class="form-check-label small fw-medium" for="selectAll">
          Pilih Semua ({{ $this->selectedItemsCount }} terpilih)
        </label>
      </div>

      @if ($this->selectedItemsCount > 0)
        <button wire:click="deleteSelected" wire:confirm="Hapus item terpilih?" class="btn btn-outline-danger btn-sm">
          <i class="fas fa-trash me-1"></i> Hapus
        </button>
      @endif
    </div>

    <!-- Mobile View -->
    <div class="d-md-none">
      @foreach ($cartItems as $item)
        <div
          class="card mb-3 border-0 shadow-sm {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'border-danger' : '' }}">
          @if ($item->produkUkuran && $item->produkUkuran->stok == 0)
            <div class="alert alert-danger alert-sm m-0 rounded-bottom-0" style="border-radius: 0;">
              <small><i class="fas fa-exclamation-triangle me-1"></i> Produk habis</small>
            </div>
          @endif

          <div class="card-body p-3">
            <!-- Checkbox dan Product Info -->
            <div class="d-flex align-items-start mb-3">
              <div class="form-check me-2 flex-shrink-0">
                <input class="form-check-input border-success" type="checkbox" wire:model.live="selectedItems"
                  value="{{ $item->id_keranjang }}" id="item-{{ $item->id_keranjang }}-mobile"
                  {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'disabled' : '' }}>
              </div>

              <!-- Gambar Produk -->
              @if ($item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->foto_utama)
                <img src="{{ asset($item->produkUkuran->produk->foto_utama) }}"
                  alt="{{ $item->produkUkuran->produk->nama }}" width="60" height="60"
                  class="me-3 rounded object-fit-cover flex-shrink-0 {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'opacity-50' : '' }}">
              @else
                <img src="{{ asset('images/default/default-product.png') }}" alt="Default Product" width="60"
                  height="60"
                  class="me-3 rounded object-fit-cover flex-shrink-0 {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'opacity-50' : '' }}">
              @endif

              <div class="flex-grow-1">
                <h6
                  class="fw-semibold mb-1 text-dark small {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'text-muted' : '' }}">
                  {{ $item->produkUkuran && $item->produkUkuran->produk ? $item->produkUkuran->produk->nama : 'Produk tidak tersedia' }}
                  @if ($item->produkUkuran && $item->produkUkuran->stok == 0)
                    <span class="badge bg-danger ms-1">Habis</span>
                  @endif
                </h6>

                @if ($item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->detailTanaman)
                  <p class="small text-muted mb-2">
                    <em>{{ $item->produkUkuran->produk->detailTanaman->nama_ilmiah }}</em>
                  </p>
                @endif

                <div class="d-flex justify-content-between align-items-center">
                  <span
                    class="text-success fw-bold small {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'text-muted' : '' }}">
                    Rp
                    {{ $item->produkUkuran ? number_format($item->produkUkuran->harga, 0, ',', '.') : '0' }}
                  </span>
                  <button wire:click="deleteItem({{ $item->id_keranjang }})"
                    wire:confirm="Hapus produk dari keranjang?" class="btn btn-sm btn-outline-danger p-1"
                    title="Hapus dari keranjang">
                    <i class="fas fa-trash fa-xs"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Size, Stock and Quantity -->
            <div class="d-flex flex-column gap-2 mb-3">
              <!-- Size and Stock -->
              @if ($item->produkUkuran && $item->produkUkuran->ukuran)
                <div class="d-flex align-items-center gap-2 flex-wrap">
                  <span class="badge bg-secondary bg-opacity-25 text-dark border border-secondary small py-1">
                    <i class="fas fa-ruler me-1"></i>
                    {{ $item->produkUkuran->ukuran->nama_ukuran }}
                  </span>

                  @if ($item->produkUkuran->stok > 0)
                    <span class="badge bg-info bg-opacity-25 text-dark border border-info small py-1">
                      <i class="fa-solid fa-basket-shopping"></i>
                      Stok: {{ $item->produkUkuran->stok }}
                    </span>
                  @else
                    <span class="badge bg-danger bg-opacity-25 text-dark border border-danger small py-1">
                      <i class="fas fa-times me-1"></i>
                      Stok Habis
                    </span>
                  @endif
                </div>
              @endif

              <!-- Quantity -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="small text-muted">Kuantitas:</span>
                <div class="btn-group btn-group-sm" role="group">
                  <button type="button" class="btn btn-outline-secondary position-relative"
                    wire:click="updateQuantity({{ $item->id_keranjang }}, -1)" wire:loading.attr="disabled"
                    {{ $item->jumlah <= 1 || ($item->produkUkuran && $item->produkUkuran->stok == 0) ? 'disabled' : '' }}>
                    <i class="fas fa-minus"></i>
                    <div wire:loading wire:target="updateQuantity({{ $item->id_keranjang }}, -1)"
                      class="position-absolute top-50 start-50 translate-middle">
                      <i class="fas fa-spinner fa-spin fa-xs"></i>
                    </div>
                  </button>
                  <button type="button"
                    class="btn btn-outline-secondary disabled px-3 {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'bg-light text-muted' : '' }}">
                    <span>{{ $item->jumlah }}</span>
                  </button>
                  <button type="button" class="btn btn-outline-secondary position-relative"
                    wire:click="updateQuantity({{ $item->id_keranjang }}, 1)" wire:loading.attr="disabled"
                    {{ ($item->produkUkuran && $item->jumlah >= $item->produkUkuran->stok) || ($item->produkUkuran && $item->produkUkuran->stok == 0) ? 'disabled' : '' }}>
                    <i class="fas fa-plus"></i>
                    <div wire:loading wire:target="updateQuantity({{ $item->id_keranjang }}, 1)"
                      class="position-absolute top-50 start-50 translate-middle">
                      <i class="fas fa-spinner fa-spin fa-xs"></i>
                    </div>
                  </button>
                </div>
              </div>
            </div>

            <!-- Subtotal -->
            <div class="pt-2 border-top">
              <div class="d-flex justify-content-between align-items-center">
                <span class="small text-muted">Subtotal:</span>
                <strong
                  class="text-dark small {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'text-muted' : '' }}">
                  Rp
                  {{ number_format(($item->produkUkuran ? $item->produkUkuran->harga : 0) * $item->jumlah, 0, ',', '.') }}
                </strong>
              </div>
            </div>
          </div>
        </div>
      @endforeach

      <!-- Mobile Order Summary -->
      @if ($this->selectedItemsCount > 0)
        <div class="bg-white border-top shadow-lg mt-3 sticky-bottom">
          <div class="p-3">
            @php
              $selectedTotal = $this->selectedTotalPrice;
              $pajak = $selectedTotal * 0.11;
              $totalAkhir = $selectedTotal + $pajak;
            @endphp

            <div class="d-flex justify-content-between align-items-center mb-2">
              <div>
                <div class="small text-muted">Total Pembayaran</div>
                <div class="fw-bold text-success h6 mb-0">
                  Rp {{ number_format($totalAkhir, 0, ',', '.') }}
                </div>
                <div class="small text-muted">
                  Termasuk pajak 11% (Rp {{ number_format($pajak, 0, ',', '.') }})
                </div>
                <div class="small text-muted">
                  {{ $this->selectedItemsCount }} item terpilih
                </div>
              </div>
              <button wire:click="checkoutSelected" class="btn btn-success flex-shrink-0 ms-2">
                <span wire:loading.remove>Checkout</span>
                <span wire:loading>
                  <i class="fas fa-spinner fa-spin"></i>
                </span>
              </button>
            </div>

            <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 mt-2 small">
              Lanjutkan Belanja
            </a>
          </div>
        </div>
      @else
        <!-- Empty Selection Message Mobile -->
        <div class="text-center py-4">
          <i class="fas fa-check-circle text-muted fa-2x mb-2"></i>
          <p class="text-muted small">Pilih item untuk checkout</p>
          <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm">
            Lanjutkan Belanja
          </a>
        </div>
      @endif
    </div>

    <!-- Desktop View -->
    <div class="d-none d-md-block">
      <div class="row">
        <!-- Daftar Produk -->
        <div class="col-md-8">
          <div class="list-group">
            @foreach ($cartItems as $item)
              <div
                class="list-group-item list-group-item-action mb-3 rounded {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'border-danger' : '' }}">
                @if ($item->produkUkuran && $item->produkUkuran->stok == 0)
                  <div class="alert alert-danger alert-sm mb-3" style="border-radius: 8px;">
                    <small><i class="fas fa-exclamation-triangle me-1"></i> Produk ini sedang habis
                      dan tidak dapat diproses</small>
                  </div>
                @endif

                <div class="d-flex align-items-start">
                  <!-- Checkbox -->
                  <div class="form-check me-3 flex-shrink-0 mt-1">
                    <input class="form-check-input border-success" type="checkbox" wire:model.live="selectedItems"
                      value="{{ $item->id_keranjang }}" id="item-{{ $item->id_keranjang }}-desktop"
                      {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'disabled' : '' }}>
                  </div>

                  <!-- Gambar Produk -->
                  @if ($item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->foto_utama)
                    <img src="{{ asset($item->produkUkuran->produk->foto_utama) }}"
                      alt="{{ $item->produkUkuran->produk->nama }}" width="80" height="80"
                      class="me-3 rounded object-fit-cover flex-shrink-0 {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'opacity-50' : '' }}">
                  @else
                    <img src="{{ asset('images/default/default-product.png') }}" alt="Default Product"
                      width="80" height="80"
                      class="me-3 rounded object-fit-cover flex-shrink-0 {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'opacity-50' : '' }}">
                  @endif

                  <div class="flex-grow-1">
                    <!-- Header dengan nama, harga, dan delete -->
                    <div class="d-flex justify-content-between align-items-start mb-0">
                      <h6
                        class="fw-semibold mb-0 text-break me-md-1 {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'text-muted' : '' }}"
                        style="flex: 1 1 200px; min-width: 0;">
                        {{ $item->produkUkuran && $item->produkUkuran->produk ? $item->produkUkuran->produk->nama : 'Produk tidak tersedia' }}
                        @if ($item->produkUkuran && $item->produkUkuran->stok == 0)
                          <span class="badge bg-danger ms-2">Habis</span>
                        @endif
                      </h6>
                      <div class="d-flex align-items-center gap-2">
                        <span
                          class="text-success fw-semibold {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'text-muted' : '' }}">
                          Rp
                          {{ $item->produkUkuran ? number_format($item->produkUkuran->harga, 0, ',', '.') : '0' }}
                        </span>
                        <button wire:click="deleteItem({{ $item->id_keranjang }})"
                          wire:confirm="Hapus produk dari keranjang?" class="btn btn-sm btn-outline-danger"
                          title="Hapus dari keranjang">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </div>

                    <!-- Nama Ilmiah -->
                    @if ($item->produkUkuran && $item->produkUkuran->produk && $item->produkUkuran->produk->detailTanaman)
                      <p class="small text-muted mb-2">
                        <em>{{ $item->produkUkuran->produk->detailTanaman->nama_ilmiah }}</em>
                      </p>
                    @endif

                    <!-- Size and Stock -->
                    @if ($item->produkUkuran && $item->produkUkuran->ukuran)
                      <div class="mb-3">
                        <div class="d-flex align-items-center gap-2">
                          <span class="badge bg-secondary bg-opacity-25 text-dark border border-secondary small py-2">
                            <i class="fas fa-ruler me-1"></i>
                            {{ $item->produkUkuran->ukuran->nama_ukuran }}
                          </span>

                          @if ($item->produkUkuran->stok > 0)
                            <span class="badge bg-info bg-opacity-25 text-dark border border-info small py-2">
                              <i class="fa-solid fa-basket-shopping"></i>
                              Stok: {{ $item->produkUkuran->stok }}
                            </span>
                          @else
                            <span class="badge bg-danger bg-opacity-25 text-dark border border-danger small py-2">
                              <i class="fas fa-times me-1"></i>
                              Stok Habis
                            </span>
                          @endif
                        </div>
                      </div>
                    @endif

                    <!-- Quantity dan Subtotal -->
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <span class="small text-muted me-2">Kuantitas:</span>
                        <div class="btn-group btn-group-sm" role="group">
                          <button type="button" class="btn btn-outline-secondary position-relative"
                            wire:click="updateQuantity({{ $item->id_keranjang }}, -1)" wire:loading.attr="disabled"
                            {{ $item->jumlah <= 1 || ($item->produkUkuran && $item->produkUkuran->stok == 0) ? 'disabled' : '' }}>
                            <i class="fas fa-minus"></i>
                            <div wire:loading wire:target="updateQuantity({{ $item->id_keranjang }}, -1)"
                              class="position-absolute top-50 start-50 translate-middle">
                              <i class="fas fa-spinner fa-spin"></i>
                            </div>
                          </button>
                          <button type="button"
                            class="btn btn-outline-secondary disabled px-3 {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'bg-light text-muted' : '' }}">
                            {{ $item->jumlah }}
                          </button>
                          <button type="button" class="btn btn-outline-secondary position-relative"
                            wire:click="updateQuantity({{ $item->id_keranjang }}, 1)" wire:loading.attr="disabled"
                            {{ ($item->produkUkuran && $item->jumlah >= $item->produkUkuran->stok) || ($item->produkUkuran && $item->produkUkuran->stok == 0) ? 'disabled' : '' }}>
                            <i class="fas fa-plus"></i>
                            <div wire:loading wire:target="updateQuantity({{ $item->id_keranjang }}, 1)"
                              class="position-absolute top-50 start-50 translate-middle">
                              <i class="fas fa-spinner fa-spin"></i>
                            </div>
                          </button>
                        </div>
                      </div>

                      <strong
                        class="text-dark {{ $item->produkUkuran && $item->produkUkuran->stok == 0 ? 'text-muted' : '' }}">
                        Subtotal: Rp
                        {{ number_format(($item->produkUkuran ? $item->produkUkuran->harga : 0) * $item->jumlah, 0, ',', '.') }}
                      </strong>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-md-4">
          @if ($this->selectedItemsCount > 0)
            <div class="card border-0 bg-light position-sticky" style="top: 80px;">
              <div class="card-body">
                <h6 class="fw-bold mb-3">Ringkasan pesanan</h6>

                <div class="d-flex justify-content-between mb-2">
                  <span class="text-muted">Item terpilih</span>
                  <span class="fw-bold">{{ $this->selectedItemsCount }} item</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                  <span class="text-muted">Sub-total</span>
                  <span class="fw-bold">Rp
                    {{ number_format($this->selectedTotalPrice, 0, ',', '.') }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                  <span class="text-muted">Pengiriman</span>
                  <span class="text-success">Gratis</span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                  <span class="text-muted">Pajak</span>
                  <span>11%</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-4">
                  <span class="fw-bold">Total</span>
                  @php
                    $pajak = $this->selectedTotalPrice * 0.11;
                    $totalAkhir = $this->selectedTotalPrice + $pajak;
                  @endphp
                  <span class="fw-bold text-success">Rp
                    {{ number_format($totalAkhir, 0, ',', '.') }}</span>
                </div>

                <button wire:click="checkoutSelected" class="btn btn-success w-100 mb-2">
                  <span wire:loading.remove>Checkout ({{ $this->selectedItemsCount }} item)</span>
                  <span wire:loading>
                    <i class="fas fa-spinner fa-spin me-1"></i> Memproses...
                  </span>
                </button>

                <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100">
                  Lanjutkan Belanja
                </a>
              </div>
            </div>
          @else
            <div class="card border-0 bg-light position-sticky" style="top: 80px;">
              <div class="card-body text-center py-5">
                <i class="fas fa-check-circle text-muted mb-3" style="font-size: 2rem;"></i>
                <p class="text-muted mb-3">Pilih item untuk checkout</p>
                <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm">
                  Lanjutkan Belanja
                </a>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  @else
    <!-- Keranjang Kosong -->
    <div class="text-center py-4">
      <img src="{{ asset('images/default/empty-cart.svg') }}" class="img-fluid w-75 w-md-50 mb-3"
        alt="Keranjang kosong" style="max-height: 200px;">
      <h5 class="text-muted fw-bold mb-3">Keranjang belanja kosong</h5>
      <p class="text-muted small mx-auto mb-4 px-3" style="max-width: 400px;">
        Sepertinya anda belum menambahkan tanaman apa pun ke keranjang. Temukan koleksi
        tanaman cantik kami dan temukan tanaman hijau yang sempurna untuk anda.
      </p>
      <a href="{{ url('/') }}" class="btn btn-green text-white">
        <i class="fas fa-shopping-cart me-1"></i> Mulai Belanja
      </a>
    </div>
  @endif
</div>
