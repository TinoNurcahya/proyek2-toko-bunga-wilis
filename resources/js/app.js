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
