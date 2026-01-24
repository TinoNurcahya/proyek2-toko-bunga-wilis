@extends('layouts.app')

@section('title', 'Cara Memesan')

@section('content')
  <div class="container py-5 mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <h1 class="mb-4 text-center fraunces">Cara Memesan</h1>

        <div class="card border-0 shadow-sm">
          <div class="card-body p-4 p-md-5">
            <div class="steps">

              <div class="step mb-5">
                <h4 class="text-primary fraunces">📋 Langkah 1: Pilih Produk</h4>
                <p class="mb-0 montserrat">
                  Kunjungi halaman produk Toko Bunga Wilis dan pilih rangkaian bunga yang Anda inginkan.
                  Klik tombol <strong>Detail</strong> untuk melihat informasi produk secara lengkap.
                </p>
              </div>

              <div class="step mb-5">
                <h4 class="text-primary fraunces">🛒 Langkah 2: Tambah ke Keranjang</h4>
                <p class="mb-0 montserrat">
                  Klik tombol <strong>Tambah ke Keranjang</strong>.
                  Anda dapat menyesuaikan jumlah produk sebelum melanjutkan ke checkout.
                </p>
              </div>

              <div class="step mb-5">
                <h4 class="text-primary fraunces">💳 Langkah 3: Checkout & Pembayaran</h4>
                <p class="mb-2 montserrat">
                  Masuk ke halaman keranjang dan klik <strong>Checkout</strong>.
                  Lengkapi data penerima, alamat pengiriman, dan catatan khusus (jika ada).
                </p>
                <p class="mb-0 montserrat">
                  Pembayaran dilakukan melalui <strong>Midtrans Payment Gateway</strong> yang mendukung:
                  Transfer Bank (VA), E-Wallet, QRIS, dan Kartu Kredit/Debit.
                  <br>
                  <a href="https://simulator.sandbox.midtrans.com/" target="_blank" rel="noopener">
                    🔗 Simulasi pembayaran
                  </a>
                </p>
              </div>

              <div class="step mb-5">
                <h4 class="text-primary fraunces">📦 Langkah 4: Konfirmasi & Pengiriman</h4>
                <p class="mb-0 montserrat">
                  Setelah pembayaran berhasil, sistem akan melakukan konfirmasi otomatis.
                  Pesanan Anda akan segera diproses dan dikirim sesuai jadwal.
                </p>
              </div>

              <div class="step">
                <h4 class="text-primary fraunces">✅ Langkah 5: Pesanan Sampai</h4>
                <p class="mb-0 montserrat">
                  Pesanan akan diterima di alamat tujuan.
                  Jangan lupa memberikan ulasan untuk membantu meningkatkan layanan kami.
                </p>
              </div>

            </div>

            <hr class="my-5">

            <div class="alert alert-info">
              <h5 class="mb-2">💡 Tips Penting</h5>
              <ul class="mb-0">
                <li>Pastikan alamat pengiriman sudah benar</li>
                <li>Simpan bukti pembayaran / nomor invoice</li>
                <li>Periksa kembali detail pesanan sebelum checkout</li>
                <li>Hubungi customer service jika mengalami kendala</li>
              </ul>
            </div>

            <div class="mt-5 text-center">
              <a href="{{ route('produk') }}" class="btn btn-primary btn-lg px-4">
                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <style>
    .step {
      position: relative;
      padding-left: 40px;
    }

    .step h4 {
      position: relative;
    }

    .step h4::before {
      position: absolute;
      left: -40px;
      top: 0;
      width: 30px;
      height: 30px;
      background: var(--bs-primary);
      border-radius: 50%;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: bold;
    }

    .step:nth-child(1) h4::before {
      content: '1';
    }

    .step:nth-child(2) h4::before {
      content: '2';
    }

    .step:nth-child(3) h4::before {
      content: '3';
    }

    .step:nth-child(4) h4::before {
      content: '4';
    }

    .step:nth-child(5) h4::before {
      content: '5';
    }
  </style>
@endpush
