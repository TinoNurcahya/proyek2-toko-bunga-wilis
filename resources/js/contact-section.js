document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("kontak-form");

    // Hanya jalankan kode jika ada
    if (!contactForm) return;

    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const status = document.getElementById("form-status");
        const submitButton = form.querySelector('button[type="submit"]');

        // Tampilkan loading
        status.innerHTML =
            '<div class="alert alert-info">Mengirim pesan...</div>';
        submitButton.disabled = true;
        submitButton.textContent = "Mengirim...";

        fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
                Accept: "application/json",
            },
        })
            .then((response) => {
                if (response.ok) {
                    status.innerHTML =
                        '<div class="alert alert-success">Pesan berhasil dikirim! Kami akan membalas segera.</div>';
                    form.reset();
                } else {
                    status.innerHTML =
                        '<div class="alert alert-danger">Terjadi kesalahan. Silakan coba lagi.</div>';
                }
            })
            .catch((error) => {
                status.innerHTML =
                    '<div class="alert alert-danger">Terjadi kesalahan jaringan. Silakan coba lagi.</div>';
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.textContent = "Kirim";
            });
    });
});
