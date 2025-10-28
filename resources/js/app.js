import "./bootstrap";
import "bootstrap/dist/js/bootstrap.bundle";
import "../scss/app.scss";
import "@fortawesome/fontawesome-free/css/all.min.css";

// Untuk password
document
    .getElementById("togglePassword")
    .addEventListener("click", function () {
        togglePasswordVisibility("password", this);
    });

// Untuk confirm password
document
    .getElementById("togglePasswordConfirmation")
    .addEventListener("click", function () {
        togglePasswordVisibility("password_confirmation", this);
    });

// Function reusable
function togglePasswordVisibility(inputId, iconElement) {
    const passwordInput = document.getElementById(inputId);
    const icon = iconElement.querySelector("i");

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
