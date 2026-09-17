// ========================================
// SIMPUS-Mini
// Jobsheet 5 - JavaScript DOM & Event
// ========================================


// ========================================
// 1. MENU HAMBURGER
// ========================================

function initNavToggle() {

    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    // Guard clause
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {

        nav.classList.toggle("nav-open");

    });
}


// ========================================
// 2. KONFIRMASI HAPUS
// ========================================

function initHapusConfirm() {

    document.addEventListener("click", function(event) {

        const button = event.target.closest(".btn-hapus");

        if (!button) return;

        const konfirmasi = confirm(
            "Apakah kamu yakin ingin menghapus data ini?"
        );

        if (konfirmasi) {

            const baris = button.closest("tr");

            if (baris) {
                baris.remove();
            }

        }

    });
}


// ========================================
// 3. FILTER TABEL REAL-TIME
// ========================================

function initTableFilter() {

    const searchBoxes = document.querySelectorAll(".search-box");

    searchBoxes.forEach(function (searchBox) {

        searchBox.addEventListener("keyup", function () {

            const keyword = searchBox.value.toLowerCase();

            const table = document.querySelector(
                searchBox.dataset.target
            );

            if (!table) return;

            const rows = table.querySelectorAll("tbody tr");

            rows.forEach(function (row) {

                const text = row.textContent.toLowerCase();

                if (text.includes(keyword)) {

                    row.style.display = "";

                } else {

                    row.style.display = "none";

                }

            });

        });

    });
}


// ========================================
// 4. MENAMPILKAN ERROR
// ========================================

function tampilkanError(input, pesan) {

    hapusError(input);

    const span = document.createElement("span");

    span.className = "error";

    span.textContent = pesan;

    input.insertAdjacentElement("afterend", span);
}


// ========================================
// 5. MENGHAPUS ERROR
// ========================================

function hapusError(input) {

    const next = input.nextElementSibling;

    if (next && next.classList.contains("error")) {

        next.remove();

    }
}


// ========================================
// 6. VALIDASI FORM
// ========================================

function initValidasiForm() {

    const form = document.getElementById("form-tambah");

    // Guard clause
    if (!form) return;


    form.addEventListener("submit", function (e) {

        let valid = true;


        // ----------------------------------------
        // VALIDASI JUDUL BUKU / NAMA ANGGOTA
        // ----------------------------------------

        const judul = form.querySelector(
            "[name='judul'], [name='nama']"
        );

        if (judul && judul.value.trim() === "") {

            tampilkanError(
                judul,
                "Field ini wajib diisi."
            );

            valid = false;

        } else if (judul) {

            hapusError(judul);

        }


        // ----------------------------------------
        // VALIDASI PENGARANG
        // ----------------------------------------

        const pengarang = form.querySelector(
            "[name='pengarang']"
        );

        if (pengarang) {

            if (pengarang.value.trim() === "") {

                tampilkanError(
                    pengarang,
                    "Pengarang wajib diisi."
                );

                valid = false;

            } else {

                hapusError(pengarang);

            }

        }


        // ----------------------------------------
        // VALIDASI TAHUN
        // ----------------------------------------

        const tahun = form.querySelector(
            "[name='tahun']"
        );

        if (tahun) {

            const nilaiTahun = parseInt(
                tahun.value,
                10
            );

            if (
                isNaN(nilaiTahun) ||
                nilaiTahun < 1900 ||
                nilaiTahun > 2026
            ) {

                tampilkanError(
                    tahun,
                    "Tahun harus di antara 1900-2026."
                );

                valid = false;

            } else {

                hapusError(tahun);

            }

        }


        // ----------------------------------------
        // VALIDASI STOK
        // ----------------------------------------

        const stok = form.querySelector(
            "[name='stok']"
        );

        if (stok) {

            const nilaiStok = parseInt(
                stok.value,
                10
            );

            if (
                isNaN(nilaiStok) ||
                nilaiStok < 0
            ) {

                tampilkanError(
                    stok,
                    "Stok tidak boleh negatif."
                );

                valid = false;

            } else {

                hapusError(stok);

            }

        }


        // ----------------------------------------
        // VALIDASI NO ANGGOTA
        // ----------------------------------------

        const noAnggota = form.querySelector(
            "[name='no_anggota']"
        );

        if (noAnggota) {

            if (noAnggota.value.trim() === "") {

                tampilkanError(
                    noAnggota,
                    "Nomor anggota wajib diisi."
                );

                valid = false;

            } else {

                hapusError(noAnggota);

            }

        }


        // ----------------------------------------
        // VALIDASI ALAMAT
        // ----------------------------------------

        const alamat = form.querySelector(
            "[name='alamat']"
        );

        if (alamat) {

            if (alamat.value.trim() === "") {

                tampilkanError(
                    alamat,
                    "Alamat wajib diisi."
                );

                valid = false;

            } else {

                hapusError(alamat);

            }

        }


        // ----------------------------------------
        // VALIDASI NO HP
        // ----------------------------------------

        const noHp = form.querySelector(
            "[name='no_hp']"
        );

        if (noHp) {

            if (noHp.value.trim() === "") {

                tampilkanError(
                    noHp,
                    "Nomor HP wajib diisi."
                );

                valid = false;

            } else {

                hapusError(noHp);

            }

        }


        // ----------------------------------------
        // JIKA TIDAK VALID
        // ----------------------------------------

        if (!valid) {

            e.preventDefault();

        }

    });

}


// ========================================
// 7. JALANKAN SEMUA FUNGSI
// ========================================

document.addEventListener("DOMContentLoaded", function () {

    initNavToggle();

    initHapusConfirm();

    initTableFilter();

    initValidasiForm();

});