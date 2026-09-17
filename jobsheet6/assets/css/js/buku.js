// ========================================
// SIMPUS-Mini
// Jobsheet 6 - Fetch API & JSON
// Data Buku
// ========================================

async function loadBuku() {

    const tbody = document.getElementById("tabel-buku-body");
    const loading = document.getElementById("loading-indicator");

    if (!tbody) return;

    try {

        // Tampilkan loading
        if (loading) {
            loading.style.display = "block";
        }

        // Simulasi delay 600 ms
        await new Promise(function(resolve) {
            setTimeout(resolve, 600);
        });

        // Ambil data dari buku.json
        const response = await fetch("../data/buku.json");

        // Cek response
        if (!response.ok) {
            throw new Error("Gagal mengambil data buku.");
        }

        // Ubah response menjadi JSON
        const data = await response.json();

        // Kosongkan tabel
        tbody.innerHTML = "";

        // Tampilkan data buku
        data.forEach(function(buku, index) {

            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${buku.judul}</td>
                <td>${buku.pengarang}</td>
                <td>${buku.tahun}</td>
                <td>${buku.stok}</td>
                <td>
                    <button
                        type="button"
                        class="btn btn-warning btn-sm">
                        Edit
                    </button>

                    <button
                        type="button"
                        class="btn btn-danger btn-sm btn-hapus">
                        Hapus
                    </button>
                </td>
            `;

            tbody.appendChild(row);

        });

    } catch (error) {

        tbody.innerHTML = `
            <tr>
                <td colspan="6"
                    class="text-center text-danger">
                    Gagal memuat data buku.
                </td>
            </tr>
        `;

        console.error(error);

    } finally {

        // Sembunyikan loading
        if (loading) {// ========================================
// SIMPUS-Mini
// Jobsheet 6 - Fetch API & JSON
// Data Buku
// ========================================

async function loadBuku() {

    const tbody = document.getElementById("tabel-buku-body");
    const loading = document.getElementById("loading-indicator");

    if (!tbody) return;

    try {

        if (loading) {
            loading.style.display = "table-row";
        }

        // Simulasi loading 600 ms
        await new Promise(function(resolve) {
            setTimeout(resolve, 600);
        });

        // Mengambil data dari buku.json
        const response = await fetch("../data/buku.json");

        if (!response.ok) {
            throw new Error("Gagal mengambil data buku.");
        }

        const data = await response.json();

        // Hapus isi tabel
        tbody.innerHTML = "";

        // Menampilkan data buku
        data.forEach(function(buku, index) {

            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${buku.judul}</td>
                <td>${buku.pengarang}</td>
                <td>${buku.tahun}</td>
                <td>${buku.stok}</td>
                <td>
                    <button
                        type="button"
                        class="btn btn-warning btn-sm">
                        Edit
                    </button>

                    <button
                        type="button"
                        class="btn btn-danger btn-sm btn-hapus">
                        Hapus
                    </button>
                </td>
            `;

            tbody.appendChild(row);

        });

    } catch (error) {

        tbody.innerHTML = `
            <tr>
                <td
                    colspan="6"
                    class="text-center text-danger">

                    Gagal memuat data buku.

                </td>
            </tr>
        `;

        console.error(error);

    } finally {

        if (loading) {
            loading.style.display = "none";
        }

    }
}


// Jalankan saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", function() {

    loadBuku();

});
            loading.style.display = "none";
        }

    }
}


// Jalankan setelah halaman selesai dimuat
document.addEventListener("DOMContentLoaded", function() {
    loadBuku();
});