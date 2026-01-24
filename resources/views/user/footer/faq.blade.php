@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
  <div class="container py-5 mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <h1 class="mb-4 text-center fraunces">Frequently Asked Questions (FAQ)</h1>

        <div class="accordion" id="faqAccordion">

          <!-- FAQ 1 -->
          <div class="accordion-item">
            <h2 class="accordion-header fraunces" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1"
                aria-expanded="true">
                Bagaimana cara memesan produk di Toko Bunga Wilis?
              </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Anda dapat memesan produk dengan memilih bunga yang diinginkan, menambahkannya ke keranjang,
                lalu melakukan checkout. Panduan lengkap tersedia di halaman
                <a href="{{ route('footer.cara-memesan') }}">Cara Memesan</a>.
              </div>
            </div>
          </div>

          <!-- FAQ 2 -->
          <div class="accordion-item">
            <h2 class="accordion-header fraunces" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                Metode pembayaran apa saja yang tersedia?
              </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Pembayaran dilakukan melalui <strong>Midtrans Payment Gateway</strong> yang mendukung
                transfer bank (Virtual Account), e-wallet, QRIS, serta kartu kredit/debit.
                Informasi lebih lanjut dapat dilihat di
                <a href="https://midtrans.com" target="_blank" rel="noopener">website resmi Midtrans</a>.
              </div>
            </div>
          </div>

          <!-- FAQ 3 -->
          <div class="accordion-item">
            <h2 class="accordion-header fraunces" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                Apakah pembayaran saya aman?
              </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Ya. Seluruh transaksi diproses melalui Midtrans yang telah tersertifikasi dan
                menggunakan sistem keamanan berstandar industri untuk melindungi data pelanggan.
              </div>
            </div>
          </div>

          <!-- FAQ 4 -->
          <div class="accordion-item">
            <h2 class="accordion-header fraunces" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                Berapa lama proses pengiriman pesanan?
              </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Pesanan akan diproses setelah pembayaran berhasil.
                Waktu pengiriman menyesuaikan lokasi tujuan dan jadwal yang Anda pilih saat checkout.
              </div>
            </div>
          </div>

          <!-- FAQ 5 -->
          <div class="accordion-item">
            <h2 class="accordion-header fraunces" id="headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                Bagaimana jika saya mengalami kendala saat memesan?
              </button>
            </h2>
            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Jika mengalami kendala, silakan hubungi customer service Toko Bunga Wilis
                melalui kontak yang tersedia. Kami siap membantu Anda.
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
