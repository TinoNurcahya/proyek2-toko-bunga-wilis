<section class="pt-4 home-section-title mb-md-3">
    <div class="container">
        <!-- Judul -->
        <div class="text-center">
            <h3 class="fw-semibold mb-1 position-relative d-inline-block fraunces">
                Kontak
            </h3>
        </div>

        <!-- Konten -->
        <div class="row mt-4 align-items-stretch">
            <!-- Kolom Map dan Info Kontak -->
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.3905339591356!2d108.30764687453461!3d-6.472115663279969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ec74e2227dcd9%3A0x4d4be2e95a6aa703!2sToko%20Bunga%20Wilis%20Jatibarang!5e0!3m2!1sen!2sid!4v1763172910844!5m2!1sen!2sid"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Kolom Form Kontak -->
            <div class="col-md-6">
                <div class="contact-card">
                    <h5 class="fraunces mb-4">Ada yang ingin ditanyakan? Jangan ragu untuk menghubungi kami.</h5>

                    <form id="kontak-form" action="https://formspree.io/f/myzlwyqp" method="POST" class="montserrat">
                        <input type="hidden" name="_subject" value="🪴 Pesan Baru - Toko Bunga Wilis">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama"
                            required>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            required>
                        <textarea id="textarea-kontak" class="form-control" name="message" placeholder="Pesan" required></textarea>
                        <button type="submit" class="btn btn-send mt-3 montserrat text-white">Kirim</button>

                        <!-- Pesan status -->
                        <div id="form-status" class="mt-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>