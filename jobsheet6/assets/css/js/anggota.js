// ========================================
// SIMPUS-Mini
// Jobsheet 6 - Fetch API & JSON
// Data Anggota
// ========================================

async function loadAnggota() {

    const tbody = document.getElementById("tabel-anggota-body");
    const loading = document.getElementById("loading-indicator");

    if (!tbody) return;

    try {

        // Tampilkan loading
        loading.style.display = "block";

        // Simulasi delay 600ms
        await new Promise(function(resolve) {
            setTimeout(resolve, 600);
        });

        // Mengambil data dari anggota.json
        const response = await fetch("../data/anggota.json");

        // Cek response
        if (!response.ok) {
            throw new Error("Gagal mengambil data anggota.");
        }

        // Ubah response menjadi JSON
        const data = await response.json();

        // Kosongkan tabel
        tbody.innerHTML = "";

        // Menampilkan data anggota
        data.forEach(function(anggota, index) {

            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${anggota.no_anggota}</td>
                <td>${anggota.nama}</td>
                <td>${anggota.alamat}</td>
                <td>${anggota.no_hp}</td>
                <td>
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
                <td colspan="6" class="text-center text-danger">
                    Gagal memuat data anggota.
                </td>
            </tr>
        `;

        console.error(error);

    } finally {

        // Sembunyikan loading
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    loadAnggota();
});