import "./bootstrap";
import "bootstrap/dist/js/bootstrap.bundle";
import "../scss/app.scss";
import "@fortawesome/fontawesome-free/css/all.min.css";
import "./update-profile";
import "./404";


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

const togglePasswordConfirmation = document.getElementById("togglePasswordConfirmation");
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
    navbarToggler.removeAttribute('data-bs-toggle');
    navbarToggler.removeAttribute('data-bs-target');
    navbarToggler.removeAttribute('aria-expanded');
    navbarToggler.removeAttribute('aria-controls');

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


