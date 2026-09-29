const tabelPelanggan = document.querySelector('#tabel-pelanggan');
const inputCari = document.querySelector('#cari-pelanggan');

let dataPelanggan = [];

async function tampilkanPelanggan() {
  try {
    const response = await fetch('../data/pelanggan.json');

    if (!response.ok) {
      throw new Error('Data hewan pasien tidak ditemukan');
    }

    dataPelanggan = await response.json();
    renderPelanggan(dataPelanggan);
  } catch (error) {
    if (tabelPelanggan) {
      tabelPelanggan.innerHTML = `
        <tr>
          <td colspan="6" style="text-align:center;color:red">
            Gagal memuat data hewan pasien
          </td>
        </tr>
      `;
    }
    console.error(error);
  }
}

function renderPelanggan(data) {
  if (!tabelPelanggan) return;

  if (data.length === 0) {
    tabelPelanggan.innerHTML = `
      <tr>
        <td colspan="6" style="text-align:center">
          Data pelanggan tidak tersedia
        </td>
      </tr>
    `;
    return;
  }

  tabelPelanggan.innerHTML = data
    .map(
      (pelanggan, index) => `
      <tr>
        <td>${index + 1}</td>
        <td>${pelanggan.no_pelanggan}</td>
        <td>${pelanggan.nama}</td>
        <td>${pelanggan.alamat}</td>
        <td>${pelanggan.no_hp}</td>
        <td>
          <button class="btn btn-warning btn-sm">Edit</button>
          <button class="btn btn-danger btn-sm btn-hapus">Hapus</button>
        </td>
      </tr>
    `
    )
    .join('');
}

inputCari?.addEventListener('input', function () {
  const keyword = this.value.toLowerCase();

  const hasil = dataPelanggan.filter(
    (pelanggan) =>
      pelanggan.nama.toLowerCase().includes(keyword) ||
      pelanggan.no_pelanggan.toLowerCase().includes(keyword) ||
      pelanggan.alamat.toLowerCase().includes(keyword)
  );

  renderPelanggan(hasil);
});

tampilkanPelanggan();
