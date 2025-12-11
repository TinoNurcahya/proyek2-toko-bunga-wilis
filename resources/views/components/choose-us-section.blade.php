<section id="pilih-kami" class="mt-md-5 pt-4 position-relative overflow-hidden home-section-title">
  <div class="container text-center">
    <h3 class="fw-semibold mb-1 position-relative d-inline-block fraunces" data-aos="fade-down">
      Mengapa memilih kami?
    </h3>
    <p class="text-muted mx-auto mb-5 montserrat" style="max-width: 600px;" data-aos="fade-down">
      Kami menghadirkan beragam pilihan bunga segar dengan kualitas terbaik, rangkaian yang indah,
      serta harga yang bersahabat untuk setiap momen spesial Anda.
    </p>

    <div class="pilih-kami-section position-relative d-flex justify-content-center align-items-center mb-5">
      <!-- Lingkaran tengah -->
      <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('images/default/why-choose-us.png') }}" alt="">
      </div>

      <!-- Kartu keunggulan -->
      <div class="feature-card feature-top">
        <div class="card shadow-sm border-0" data-aos="fade-right" data-aos-duration="1500">
          <div class="card-body">
            <i class="fab fa-canadian-maple-leaf text-danger mb-2 fa-2x"></i>
            <h6 class="fw-semibold fraunces">Bunga Segar & Berkualitas Tinggi</h6>
            <p class="small text-muted mb-0 montserrat">
              Bunga dipilih langsung dengan standar kualitas tinggi agar selalu segar dan indah.
            </p>
          </div>
        </div>
      </div>

      <div class="feature-card feature-left">
        <div class="card shadow-sm border-0" data-aos="fade-left" data-aos-duration="1500">
          <div class="card-body">
            <i class="fa-solid fa-tags text-danger mb-2 fa-2x"></i>
            <h6 class="fw-semibold fraunces">Harga Terjangkau & Transparan</h6>
            <p class="small text-muted mb-0 montserrat">
              Nikmati harga yang terjangkau dengan informasi yang jelas tanpa biaya tersembunyi.
            </p>
          </div>
        </div>
      </div>

      <div class="feature-card feature-right">
        <div class="card shadow-sm border-0" data-aos="fade-right" data-aos-duration="1500">
          <div class="card-body">
            <i class="fa-solid fa-clover text-danger mb-2 fa-2x"></i>
            <h6 class="fw-semibold fraunces">Berbagai Pilihan</h6>
            <p class="small text-muted mb-0 montserrat">
              Temukan beragam pilihan tanaman dan rangkaian sesuai kebutuhan dan selera Anda.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Testimoni Swiper -->
    <livewire:testimonial-swiper />
  </div>
</section>
