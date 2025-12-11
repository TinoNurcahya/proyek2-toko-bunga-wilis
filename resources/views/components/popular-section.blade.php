@props(['produkTerlaris'])

<section id="paling-laris" class="pt-4 home-section-title overflow-hidden">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-semibold mb-1 position-relative d-inline-block fraunces" data-aos="fade-right">Paling Laris</h3>
      <a href="{{ url('/produk') }}" class="explore-link montserrat fw-semibold" data-aos="fade-left">
        Jelajahi Semua <i class="fa-solid fa-arrow-right ms-1"></i>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>

    <div class="row g-4">
      <!-- Kartu Produk -->
      @foreach ($produkTerlaris as $item)
        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="700" data-aos-offset="50">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset($item->foto_utama) }}" alt="{{ $item->nama }}" class="card-img-top rounded-top-3"
              alt="{{ $item->nama }}" style="height: 180px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <h4 class="card-title fraunces">{{ $item->nama }}</h4>
              <p class="card-text montserrat mb-2 text-success fw-semibold">
                @if ($item->harga_terendah && $item->harga_tertinggi && $item->harga_terendah != $item->harga_tertinggi)
                  RP{{ number_format($item->harga_terendah, 0, ',', '.') }} -
                  RP{{ number_format($item->harga_tertinggi, 0, ',', '.') }}
                @else
                  RP{{ number_format($item->harga_terendah, 0, ',', '.') }}
                @endif
              </p>


              <div class="d-flex align-items-center justify-content-between mb-3 montserrat">
                <div class="d-flex align-items-center">
                  <span class="text-warning me-1"><i class="fa-regular fa-star"></i></span>
                  <small class="text-muted">{{ number_format($item->rating, 1) }}</small>
                </div>
                <small class="text-muted">{{ $item->terjual_formatted }} terjual</small>
              </div>
              <a href="{{ route('produk.detail', $item->id_produk) }}"
                class="btn-collision mt-auto d-flex justify-content-center align-items-center montserrat">
                <span>Lihat Detail</span> <i class="fa-solid fa-arrow-right ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="text-center mt-5 montserrat">
      <div class="buttons">
        <a href="{{ url('/produk') }}">
          <button class="blob-btn" data-aos="fade-up">
            Jelajahi Semua <i class="fa-solid fa-arrow-right ms-2"></i>
            <span class="blob-btn__inner">
              <span class="blob-btn__blobs">
                <span class="blob-btn__blob"></span>
                <span class="blob-btn__blob"></span>
                <span class="blob-btn__blob"></span>
                <span class="blob-btn__blob"></span>
              </span>
            </span>
          </button>
        </a>
      </div>

      <!-- Filter efek “gooey” -->
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display:none;">
        <defs>
          <filter id="goo">
            <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10"></feGaussianBlur>
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"
              result="goo"></feColorMatrix>
            <feBlend in2="goo" in="SourceGraphic" result="mix"></feBlend>
          </filter>
        </defs>
      </svg>
    </div>

  </div>
</section>
