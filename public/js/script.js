document.addEventListener("DOMContentLoaded", function () {
    // Pilih semua elemen yang akan dianimasikan
    const sections = document.querySelectorAll(
        ".home, .mempelai, .info, .maps, .story, .gallery, .gift, .rsvp"
    );

    // Fungsi untuk mengecek apakah elemen sudah terlihat saat di-scroll
    function checkVisibility() {
        sections.forEach((section) => {
            // Mendapatkan posisi elemen relatif terhadap viewport
            const rect = section.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Jika elemen terlihat di viewport
            if (
                rect.top <= windowHeight - rect.height / 4 &&
                rect.bottom >= 0
            ) {
                section.classList.add("animate-in");
            } else {
                // Jika elemen tidak terlihat di viewport, hapus kelas animasi
                section.classList.remove("animate-in");
            }
        });
    }

    // Jalankan fungsi saat halaman dimuat untuk pertama kali
    checkVisibility();

    // Tambahkan event listener untuk scroll
    window.addEventListener("scroll", checkVisibility);
});

document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi AOS
    AOS.init({
        duration: 800,
        easing: "ease-in-out",
        once: true,
    });

    // Inisialisasi Lightbox
    document
        .querySelectorAll('[data-toggle="lightbox"]')
        .forEach(function (el) {
            el.addEventListener("click", function (e) {
                e.preventDefault();
                // Jika Anda menggunakan lightbox, tambahkan kode inisialisasi di sini
            });
        });

    // Button View More
    document
        .querySelector(".btn-view-more")
        .addEventListener("click", function () {
            // Implementasi fungsi untuk menampilkan lebih banyak gambar
            // Bisa dengan Ajax load atau menampilkan gambar yang tersembunyi
            alert(
                "Fitur ini dapat diimplementasikan untuk menampilkan lebih banyak gambar"
            );
        });
});

function copyToClipboard(elementId, successId, failedId) {
    // Dapatkan text dari elemen
    const text = document.getElementById(elementId).innerText;
    const inputId = elementId.split("-")[0] + "-input";
    const inputElem = document.getElementById(inputId);

    // Perbarui nilai pada textarea tersembunyi
    inputElem.value = text;

    // Coba menggunakan Clipboard API (modern browsers)
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard
            .writeText(text)
            .then(() => showFeedback(successId, failedId, true))
            .catch(() => tryLegacyCopy(inputElem, successId, failedId));
    } else {
        // Fallback ke metode lama jika Clipboard API tidak tersedia
        tryLegacyCopy(inputElem, successId, failedId);
    }
}

function tryLegacyCopy(inputElem, successId, failedId) {
    try {
        // Fokus dan pilih teks pada elemen input
        inputElem.style.display = "block";
        inputElem.focus();
        inputElem.select();

        // Eksekusi perintah copy
        const successful = document.execCommand("copy");

        // Sembunyikan kembali input
        inputElem.style.display = "none";

        // Tampilkan feedback
        showFeedback(successId, failedId, successful);
    } catch (err) {
        // Jika gagal, tampilkan pesan error
        showFeedback(successId, failedId, false);
    }
}

function showFeedback(successId, failedId, isSuccess) {
    const successElement = document.getElementById(successId);
    const failedElement = document.getElementById(failedId);

    if (isSuccess) {
        // Tampilkan pesan berhasil
        successElement.style.display = "block";
        failedElement.style.display = "none";

        // Hilangkan pesan setelah 3 detik
        setTimeout(function () {
            successElement.style.display = "none";
        }, 3000);
    } else {
        // Tampilkan pesan gagal
        failedElement.style.display = "block";
        successElement.style.display = "none";

        // Hilangkan pesan setelah 5 detik
        setTimeout(function () {
            failedElement.style.display = "none";
        }, 5000);
    }
}
// transition.js - File untuk mengatur transisi antar halaman

// Fungsi untuk transisi dari hero ke index
function navigateToIndex() {
    // Tambahkan kelas animasi keluar pada hero
    const heroSection = document.getElementById("hero");
    heroSection.classList.add("fade-out");

    // Delay sebelum pindah halaman
    setTimeout(function () {
        window.location.href = "index.html";
    }, 300); // Sesuaikan dengan durasi transisi
}

// Deteksi halaman yang sedang dimuat
document.addEventListener("DOMContentLoaded", function () {
    // Tambahkan kelas untuk animasi masuk
    document.body.classList.add("fade-in");

    // Hapus kelas animasi setelah transisi selesai
    setTimeout(function () {
        document.body.classList.remove("fade-in");
    }, 300);

    // Jika ada tombol undangan di halaman hero
    const inviteButton = document.querySelector(".invite-btn");
    if (inviteButton) {
        // Ubah default behavior dari link
        inviteButton.addEventListener("click", function (e) {
            e.preventDefault();
            navigateToIndex();
        });
    }
});
