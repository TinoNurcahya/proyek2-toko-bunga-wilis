// import "./bootstrap";
// import "bootstrap/dist/js/bootstrap.bundle";
// import "bootstrap/dist/js/bootstrap.bundle.min.js";
import bootstrap from "bootstrap/dist/js/bootstrap.bundle";

import "../scss/app.scss";
import "@fortawesome/fontawesome-free/css/all.min.css";
import {
    initializeSwipers,
    destroySwipers,
    refreshTestimonialSwiper,
} from "./swiper-section";
import "./contact-section";
import "./update-profile";
import "./404";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

import "photoswipe/style.css";
import AOS from "aos";
import "aos/dist/aos.css";

import Rellax from "rellax";

// Init AOS
AOS.init({
    duration: 800,
    once: false,
    mirror: true,
});

// Init Rellax
let rellax = null;

document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".parallax");

    if (elements.length === 0) return;

    rellax = new Rellax(".parallax", {
        center: true,
        round: true,
    });
});

function togglePasswordVisibility(inputId, iconElement) {
    const passwordInput = document.getElementById(inputId);
    const icon = iconElement.querySelector("i");

    if (!passwordInput || !icon) return;

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}

const togglePassword = document.getElementById("togglePassword");
if (togglePassword) {
    togglePassword.addEventListener("click", function () {
        togglePasswordVisibility("password", this);
    });
}

const togglePasswordConfirmation = document.getElementById(
    "togglePasswordConfirmation"
);
if (togglePasswordConfirmation) {
    togglePasswordConfirmation.addEventListener("click", function () {
        togglePasswordVisibility("password_confirmation", this);
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.getElementById("navbarNav");

    if (!navbarToggler || !navbarNav) return;

    const barsIcon = navbarToggler.querySelector(".fa-bars");
    const xmarkIcon = navbarToggler.querySelector(".fa-xmark");

    // Hapus atribut bootstrap bawaan
    navbarToggler.removeAttribute("data-bs-toggle");
    navbarToggler.removeAttribute("data-bs-target");
    navbarToggler.removeAttribute("aria-expanded");
    navbarToggler.removeAttribute("aria-controls");

    let isOpen = false;

    navbarToggler.addEventListener("click", function () {
        isOpen = !isOpen;

        if (isOpen) {
            navbarNav.classList.add("show");
            barsIcon.classList.add("d-none");
            xmarkIcon.classList.remove("d-none");
        } else {
            navbarNav.classList.remove("show");
            barsIcon.classList.remove("d-none");
            xmarkIcon.classList.add("d-none");
        }
    });

    // Tutup navbar otomatis ketika layar diperbesar
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768 && isOpen) {
            isOpen = false;
            navbarNav.classList.remove("show");
            barsIcon.classList.remove("d-none");
            xmarkIcon.classList.add("d-none");
        }
    });

    // Inisialisasi state awal
    navbarNav.classList.remove("show");
    barsIcon.classList.remove("d-none");
    xmarkIcon.classList.add("d-none");
});

window.addEventListener("show-toast", (event) => {
    const { type, message } = event.detail;
    const bgClass =
        {
            success: "bg-success text-white",
            info: "bg-info text-white",
            warning: "bg-warning text-dark",
            error: "bg-danger text-white",
        }[type] || "bg-secondary text-white";
    const iconClass =
        {
            success: "fas fa-check-circle",
            info: "fas fa-info-circle",
            warning: "fas fa-exclamation-triangle",
            error: "fas fa-exclamation-circle",
        }[type] || "fas fa-bell";
    const toast = document.createElement("div");
    toast.className = `toast align-items-center border-0 ${bgClass}`;
    toast.role = "alert";
    toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body d-flex align-items-start">
                    <i class="${iconClass} me-3 mt-1 flex-shrink-0"></i>
                    <span class="fw-semibold flex-grow-1" style="word-break: break-word;">${message}</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-3 m-auto flex-shrink-0" data-bs-dismiss="toast"></button>
            </div>
        `;
    document.getElementById("toastContainer").appendChild(toast);

    const bsToast = new bootstrap.Toast(toast, {
        delay: 2500,
    });
    bsToast.show();

    // Hapus elemen toast setelah animasi selesai
    toast.addEventListener("hidden.bs.toast", () => toast.remove());
});

document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.getElementById("main-navbar");
    const logo = document.getElementById("navbar-logo");

    // Jangan lanjut kalau elemen tidak ditemukan
    if (!navbar || !logo) return;

    const isLightPage = navbar.classList.contains("page-light");
    logo.src = isLightPage ? "/images/logo-dark.png" : "/images/logo.png";

    window.addEventListener("scroll", () => {
        if (window.scrollY > 180) {
            navbar.classList.add("glass-active");
            logo.src = "/images/logo-dark.png";
        } else {
            navbar.classList.remove("glass-active");
            logo.src = isLightPage
                ? "/images/logo-dark.png"
                : "/images/logo.png";
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach((link) => {
        link.addEventListener("click", function () {
            navLinks.forEach((l) => l.classList.remove("active"));
            this.classList.add("active");
        });
    });
});

// Initialize pertama kali
document.addEventListener("DOMContentLoaded", function () {
    initializeSwipers();
});

// Livewire handlers
document.addEventListener("livewire:init", () => {
    Livewire.hook("navigated", () => {
        setTimeout(() => {
            destroySwipers();
            initializeSwipers();
        }, 200);
    });

    Livewire.hook("morph.updated", ({ el }) => {
        let elements = [];
        if (Array.isArray(el)) {
            elements = el;
        } else if (el) {
            elements = [el];
        }

        let hasTestimonialSwiper = false;

        elements.forEach((element) => {
            if (element && typeof element.querySelector === "function") {
                if (element.querySelector(".testimonialSwiper")) {
                    hasTestimonialSwiper = true;
                }
            }
        });

        if (!hasTestimonialSwiper) {
            setTimeout(() => {
                destroySwipers();
                initializeSwipers();
            }, 150);
        }
    });
});

// polling refresh saja
document.addEventListener("livewire:poll", () => {
    refreshTestimonialSwiper();
});

document.addEventListener("DOMContentLoaded", function () {
    // === INTEGRASI SEARCH NAVIGATION UNTUK SEMUA HALAMAN ===
    function setupNavigationSearchIntegration() {
        const navSearchInput = document.getElementById("nav-search-input");
        const globalSearchForm = document.getElementById("global-search-form");

        if (!navSearchInput) return;

        // Cek apakah sedang di halaman produk
        const isProductsPage =
            window.location.pathname.includes("/produk") ||
            window.location.pathname === "/produk";

        if (isProductsPage) {
            // DI HALAMAN PRODUK: Real-time filtering
            navSearchInput.addEventListener("input", function () {
                if (
                    typeof state !== "undefined" &&
                    typeof filterAndSort !== "undefined"
                ) {
                    state.search = this.value.toLowerCase();
                    filterAndSort();

                    // Sinkronkan dengan search inputs di filter produk
                    const searchInputs =
                        document.querySelectorAll(".search-input");
                    searchInputs.forEach((input) => {
                        input.value = this.value;
                    });

                    // Update URL
                    updateURLWithSearch(this.value);
                }
            });
        } else {
            // DI HALAMAN LAIN: Form submission biasa
            console.log("Navigation search: Redirect ke halaman produk");
        }

        // Handle URL parameter untuk search
        const urlParams = new URLSearchParams(window.location.search);
        const searchFromURL = urlParams.get("search");

        if (searchFromURL) {
            const decodedSearch = decodeURIComponent(searchFromURL);
            navSearchInput.value = decodedSearch;

            if (isProductsPage && typeof state !== "undefined") {
                state.search = decodedSearch.toLowerCase();
            }
        }

        // Function untuk update URL
        function updateURLWithSearch(searchTerm) {
            const url = new URL(window.location);
            if (searchTerm.trim()) {
                url.searchParams.set("search", searchTerm.trim());
            } else {
                url.searchParams.delete("search");
            }
            window.history.pushState({}, "", url);
        }
    }

    // === KODE UNTUK HALAMAN PRODUK ===
    const productContainer = document.getElementById("product-container");

    if (productContainer) {
        // Inisialisasi state dan fungsi hanya untuk halaman produk
        const productCards = Array.from(
            document.querySelectorAll(".product-card")
        );
        const noProducts = document.getElementById("no-products");
        const productCount = document.getElementById("product-count");
        const searchInputs = document.querySelectorAll(".search-input");

        let state = {
            category: "all",
            price: "all",
            sort: "terbaru",
            search: "",
            terlaris: "all",
        };

        // Update text tombol berdasarkan tombol induknya
        function updateButton(optionElement) {
            const dropdownType = optionElement.classList[1];
            const value = optionElement.dataset.value;

            // Update semua tombol dengan class yang sama
            document
                .querySelectorAll(`.${dropdownType}[data-value="${value}"]`)
                .forEach((opt) => {
                    const allOptions = opt
                        .closest(".dropdown-menu")
                        .querySelectorAll(".dropdown-item");
                    allOptions.forEach((x) => x.classList.remove("active"));
                    opt.classList.add("active");
                });

            // Update semua tombol dropdown dengan class yang sesuai
            const buttonClass = getButtonClassFromOption(dropdownType);
            const newText = optionElement.textContent.trim();

            document.querySelectorAll(buttonClass).forEach((button) => {
                const icon = button.querySelector("i").cloneNode(true);
                button.innerHTML = "";
                button.appendChild(icon);
                button.append(" " + newText);
            });
        }

        // Helper function untuk mapping option class ke button class
        function getButtonClassFromOption(optionClass) {
            const mapping = {
                "category-option": ".dropdown-kategori",
                "sort-option": ".dropdown-sort",
                "price-option": ".dropdown-harga",
                "terlaris-option": ".dropdown-terlaris",
            };
            return mapping[optionClass] || "";
        }

        // Reset semua tombol ke default
        function resetAllButtons() {
            // Reset kategori
            document.querySelectorAll(".dropdown-kategori").forEach((btn) => {
                btn.innerHTML =
                    '<i class="fas fa-layer-group me-1 text-primary"></i> Kategori';
            });

            // Reset sort
            document.querySelectorAll(".dropdown-sort").forEach((btn) => {
                btn.innerHTML =
                    '<i class="fas fa-sort me-1 text-success"></i> Terbaru';
            });

            // Reset harga
            document.querySelectorAll(".dropdown-harga").forEach((btn) => {
                btn.innerHTML =
                    '<i class="fas fa-tag me-1 text-warning"></i> Harga';
            });

            // Reset terlaris
            document.querySelectorAll(".dropdown-terlaris").forEach((btn) => {
                btn.innerHTML =
                    '<i class="fas fa-fire me-1 text-danger"></i> Terlaris';
            });
        }

        // Update UI Count + Empty
        function updateUI(count) {
            if (productCount) {
                productCount.textContent = `${count} produk`;
            }

            if (noProducts && productContainer) {
                if (count === 0) {
                    noProducts.classList.remove("d-none");
                    productContainer.classList.add("d-none");
                } else {
                    noProducts.classList.add("d-none");
                    productContainer.classList.remove("d-none");
                }
            }
        }

        // Filter + Sort Logic
        function filterAndSort() {
            const term = state.search.toLowerCase().trim();
            let visible = [];

            productCards.forEach((card) => {
                const name = card.dataset.name;
                const category = card.dataset.category;
                const price = parseInt(card.dataset.price) || 0;
                const date = new Date(card.dataset.date);
                const rating = parseFloat(card.dataset.rating) || 0;
                const sold = parseInt(card.dataset.sold) || 0;

                const matchSearch = term === "" || name.includes(term);
                const matchCategory =
                    state.category === "all" || category === state.category;

                // PRICE
                let matchPrice = true;
                if (state.price !== "all") {
                    if (state.price.includes("-")) {
                        const [min, max] = state.price.split("-").map(Number);
                        matchPrice = price >= min && price <= max;
                    }
                }

                // BEST SELLER
                let matchTerlaris = true;
                if (state.terlaris !== "all") {
                    matchTerlaris = sold >= parseInt(state.terlaris);
                }

                const isVisible =
                    matchSearch && matchCategory && matchPrice && matchTerlaris;

                if (isVisible) {
                    card.style.display = "block";
                    visible.push({
                        element: card,
                        date: date,
                        price: price,
                        rating: rating,
                        sold: sold,
                    });
                } else {
                    card.style.display = "none";
                }
            });

            // SORT
            visible.sort((a, b) => {
                switch (state.sort) {
                    case "terbaru":
                        return b.date - a.date;
                    case "terlama":
                        return a.date - b.date;
                    case "rating_tertinggi":
                        return b.rating - a.rating;
                }
            });

            // PRICE SORT
            if (state.price === "harga_terendah") {
                visible.sort((a, b) => a.price - b.price);
            } else if (state.price === "harga_tertinggi") {
                visible.sort((a, b) => b.price - a.price);
            }

            visible.forEach((item) =>
                productContainer.appendChild(item.element)
            );
            updateUI(visible.length);
        }

        // EVENT LISTENER GLOBAL UNTUK SEMUA DROPDOWN
        document.addEventListener("click", function (e) {
            const option = e.target.closest(".dropdown-item");
            if (!option) return;

            // Tentukan filter mana
            if (option.classList.contains("category-option")) {
                state.category = option.dataset.value;
            }
            if (option.classList.contains("sort-option")) {
                state.sort = option.dataset.value;
            }
            if (option.classList.contains("price-option")) {
                state.price = option.dataset.value;
            }
            if (option.classList.contains("terlaris-option")) {
                state.terlaris = option.dataset.value;
            }

            updateButton(option);
            filterAndSort();

            // Tutup dropdown
            const dropdown = option.closest(".dropdown");
            const toggleBtn = dropdown.querySelector(".dropdown-toggle");
            const bs = bootstrap.Dropdown.getInstance(toggleBtn);
            if (bs) bs.hide();

            // Jika di mobile, tutup offcanvas setelah memilih
            if (window.innerWidth < 768) {
                const offcanvas = bootstrap.Offcanvas.getInstance(
                    document.getElementById("filterOffcanvas")
                );
                if (offcanvas) offcanvas.hide();
            }
        });

        // SEARCH di halaman produk - SINCRONISASI DENGAN NAVIGATION
        searchInputs.forEach((input) => {
            input.addEventListener("input", function () {
                state.search = this.value.toLowerCase();
                filterAndSort();

                // Sinkronkan input lainnya di filter
                searchInputs.forEach((i) => {
                    if (i !== this) i.value = this.value;
                });

                // SINCRONKAN DENGAN NAVIGATION SEARCH
                const navSearchInput =
                    document.getElementById("nav-search-input");
                if (navSearchInput && navSearchInput.value !== this.value) {
                    navSearchInput.value = this.value;
                }

                // Update URL
                const url = new URL(window.location);
                if (this.value.trim()) {
                    url.searchParams.set("search", this.value.trim());
                } else {
                    url.searchParams.delete("search");
                }
                window.history.pushState({}, "", url);
            });
        });

        // RESET - SINCRONKAN DENGAN NAVIGATION
        document.querySelectorAll(".reset-filters").forEach((resetBtn) => {
            resetBtn.addEventListener("click", function () {
                state = {
                    category: "all",
                    price: "all",
                    sort: "terbaru",
                    search: "",
                    terlaris: "all",
                };

                // Reset semua dropdown-item di semua instance
                document
                    .querySelectorAll(".dropdown-item")
                    .forEach((x) => x.classList.remove("active"));

                // Set active default di semua instance
                document
                    .querySelectorAll('.category-option[data-value="all"]')
                    .forEach((el) => el.classList.add("active"));
                document
                    .querySelectorAll('.price-option[data-value="all"]')
                    .forEach((el) => el.classList.add("active"));
                document
                    .querySelectorAll('.sort-option[data-value="terbaru"]')
                    .forEach((el) => el.classList.add("active"));
                document
                    .querySelectorAll('.terlaris-option[data-value="all"]')
                    .forEach((el) => el.classList.add("active"));

                // Reset semua tombol
                resetAllButtons();

                // Reset search inputs di filter
                searchInputs.forEach((i) => (i.value = ""));

                // RESET NAVIGATION SEARCH
                const navSearchInput =
                    document.getElementById("nav-search-input");
                if (navSearchInput) {
                    navSearchInput.value = "";
                }

                // Update URL
                const url = new URL(window.location);
                url.searchParams.delete("search");
                url.searchParams.delete("category");
                window.history.pushState({}, "", url);

                filterAndSort();
            });
        });

        // Handle URL parameter untuk kategori DAN search
        const urlParams = new URLSearchParams(window.location.search);
        const categoryFromURL = urlParams.get("category");
        const searchFromURL = urlParams.get("search");

        if (categoryFromURL) {
            state.category = categoryFromURL;

            // Set active berdasarkan URL
            document
                .querySelectorAll(".category-option")
                .forEach((el) => el.classList.remove("active"));
            document
                .querySelectorAll(
                    `.category-option[data-value="${categoryFromURL}"]`
                )
                .forEach((selected) => {
                    selected.classList.add("active");

                    // Update tombol
                    document
                        .querySelectorAll(".dropdown-kategori")
                        .forEach((btn) => {
                            btn.innerHTML = `<i class="fas fa-layer-group me-1 text-primary"></i> ${selected.textContent.trim()}`;
                        });
                });
        }

        // Handle URL parameter untuk search - SINCRONKAN SEMUA
        if (searchFromURL) {
            const decodedSearch = decodeURIComponent(searchFromURL);
            state.search = decodedSearch.toLowerCase();

            // Update semua search inputs di filter
            searchInputs.forEach((input) => {
                input.value = decodedSearch;
            });

            // Update navigation search juga
            const navSearchInput = document.getElementById("nav-search-input");
            if (navSearchInput) {
                navSearchInput.value = decodedSearch;
            }
        }

        // Filter and sort initial
        filterAndSort();

        // Tombol pada section kategori
        document.querySelectorAll(".category-link").forEach((btn) => {
            btn.addEventListener("click", function () {
                const category = this.dataset.category;
                window.location.href = "/produk?category=" + category;
            });
        });
    }

    // === INISIALISASI SEARCH NAVIGATION UNTUK SEMUA HALAMAN ===
    setupNavigationSearchIntegration();
});
