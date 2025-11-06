document.addEventListener("DOMContentLoaded", function () {
    // Elemen-elemen yang perlu disinkronisasi
    const hapusFotoInput = document.getElementById("hapus_foto");
    const btnHapusMobile = document.getElementById("btn-hapus-mobile");
    const btnHapusDesktop = document.getElementById("btn-hapus-desktop");
    const fileInputMobile = document.getElementById("foto_profil_mobile");
    const fileInputDesktop = document.getElementById("foto_profil_desktop");

    // Fungsi untuk mengaktifkan hapus foto
    function enableDeletePhoto() {
        hapusFotoInput.value = "1";

        // Nonaktifkan kedua tombol hapus
        if (btnHapusMobile) btnHapusMobile.disabled = true;
        if (btnHapusDesktop) btnHapusDesktop.disabled = true;

        // Reset input file
        if (fileInputMobile) fileInputMobile.value = "";
        if (fileInputDesktop) fileInputDesktop.value = "";
    }

    // Event listener untuk tombol hapus mobile
    if (btnHapusMobile) {
        btnHapusMobile.addEventListener("click", enableDeletePhoto);
    }

    // Event listener untuk tombol hapus desktop
    if (btnHapusDesktop) {
        btnHapusDesktop.addEventListener("click", enableDeletePhoto);
    }

    // Sinkronisasi input file antara mobile dan desktop
    if (fileInputMobile && fileInputDesktop) {
        fileInputMobile.addEventListener("change", function () {
            fileInputDesktop.files = this.files;
            // Jika memilih file baru, reset hapus foto
            if (this.files.length > 0) {
                hapusFotoInput.value = "0";
                if (btnHapusMobile) btnHapusMobile.disabled = false;
                if (btnHapusDesktop) btnHapusDesktop.disabled = false;
            }
        });

        fileInputDesktop.addEventListener("change", function () {
            fileInputMobile.files = this.files;
            // Jika memilih file baru, reset hapus foto
            if (this.files.length > 0) {
                hapusFotoInput.value = "0";
                if (btnHapusMobile) btnHapusMobile.disabled = false;
                if (btnHapusDesktop) btnHapusDesktop.disabled = false;
            }
        });
    }

    // Reset hapus foto jika form direset
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("reset", function () {
            hapusFotoInput.value = "0";
            if (btnHapusMobile) btnHapusMobile.disabled = false;
            if (btnHapusDesktop) btnHapusDesktop.disabled = false;
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Untuk mobile
    const btnMobile = document.getElementById("btn-pilih-mobile");
    const inputMobile = document.getElementById("foto_profil_mobile");
    const fileNameMobile = document.getElementById("file-name-mobile");

    if (btnMobile && inputMobile && fileNameMobile) {
        btnMobile.addEventListener("click", function () {
            inputMobile.click();
        });

        inputMobile.addEventListener("change", function () {
            if (this.files.length > 0) {
                fileNameMobile.textContent = this.files[0].name;
                fileNameMobile.className = "ms-2 text-success small";
            } else {
                fileNameMobile.textContent = "Belum ada file dipilih";
                fileNameMobile.className = "ms-2 text-muted small";
            }
        });
    }

    // Untuk desktop 
    const btnDesktop = document.getElementById("btn-pilih-desktop");
    const inputDesktop = document.getElementById("foto_profil_desktop");
    const fileNameDesktop = document.getElementById("file-name-desktop");

    if (btnDesktop && inputDesktop && fileNameDesktop) {
        btnDesktop.addEventListener("click", function () {
            inputDesktop.click();
        });

        inputDesktop.addEventListener("change", function () {
            if (this.files.length > 0) {
                fileNameDesktop.textContent = this.files[0].name;
                fileNameDesktop.className = "ms-2 text-success small fw-bold";
            } else {
                fileNameDesktop.textContent = "Belum ada file dipilih";
                fileNameDesktop.className = "ms-2 text-muted small";
            }
        });
    }
});
