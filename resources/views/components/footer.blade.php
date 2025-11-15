<footer class="text-white">
    <div class="container">
        <div class="row text-start align-items-start justify-content-center">
            <!-- Kolom 1 -->
            <div class="col-lg-3 col-md-6 mb-4 footer-info">
                <h5 class="footer-title"><i class="fa-solid fa-seedling me-2"></i>Wilis Garden</h5>
                <p class="montserrat">
                    Toko Bunga Wilis adalah marketplace tanaman segar yang hadir untuk memudahkan Anda
                    mendapatkan
                    tanaman berkualitas langsung dari sumber terbaik.
                </p>
            </div>

            <!-- Kolom 2-4 dibungkus supaya bisa digeser bersama -->
            <div class="col-lg-8 offset-lg-1 footer-links">
                <div class="row">
                    <!-- Kolom 2 -->
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">Tautan</h5>
                        <ul class="list-unstyled montserrat">
                            <li><a href="#">Beranda</a></li>
                            <li><a href="#">Produk</a></li>
                            <li><a href="{{ url('/') }}#tentang">Tentang Kami</a></li>
                            <li><a href="#">Mengapa Memilih Kami?</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 3 -->
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">Bantuan</h5>
                        <ul class="list-unstyled montserrat">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Chat dengan Kami</a></li>
                            <li><a href="#">Cara Memesan</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 4 -->
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">Hubungi Kami</h5>
                        <p class="montserrat"><i class="fa-solid fa-location-dot me-2"></i>Jl. Sojar, Bulak, Kec. Jatibarang</p>
                        <p class="montserrat"><i class="fa-brands fa-whatsapp me-2"></i>+62 812-3456-7890</p>
                        <p class="montserrat"><i class="fa-regular fa-envelope me-2"></i>tokobungawilis@gmail.com</p>
                        <div class="social-icons mt-3">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="row">
            <div
                class="col-md-12 d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start">
                <p class="mb-2 mb-md-0 ms-4">
                    <a href="#" class="mx-1">Privacy Policy</a> • <a href="#" class="mx-1">Cookie
                        Policy</a> •
                    <a href="#" class="mx-1">Terms of Use</a> •
                    <a href="#" class="mx-1">Refund Policy</a>
                </p>
                <p class="mb-0 me-4">&copy; {{ now()->year }} Wilis Garden. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
