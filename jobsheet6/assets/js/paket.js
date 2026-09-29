const tabelPaket = document.querySelector('#tabel-paket');
const inputCari = document.querySelector('#cari-paket');

let dataPaket = [];

async function tampilkanPaket() {
  try {
    const response = await fetch('../data/paket.json');

    if (!response.ok) {
      throw new Error('Data layanan klinik tidak ditemukan');
    }

    dataPaket = await response.json();
    renderPaket(dataPaket);
  } catch (error) {
    if (tabelPaket) {
      tabelPaket.innerHTML = `
        <tr>
          <td colspan="6" style="text-align:center;color:red">
            Gagal memuat data layanan klinik
          </td>
        </tr>
      `;
    }
    console.error(error);
  }
}

function renderPaket(data) {
  if (!tabelPaket) return;

  if (data.length === 0) {
    tabelPaket.innerHTML = `
      <tr>
        <td colspan="6" style="text-align:center">
          Tidak ada paket yang cocok dengan pencarian
        </td>
      </tr>
    `;
    return;
  }

  tabelPaket.innerHTML = data
    .map(
      (paket, index) => `
      <tr>
        <td>${index + 1}</td>
        <td>${paket.nama_paket}</td>
        <td>${paket.jenis}</td>
        <td>Rp ${Number(paket.harga).toLocaleString('id-ID')}</td>
        <td>${paket.estimasi}</td>
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
  const keyword = this.value.trim().toLowerCase();

  const hasil = dataPaket.filter(
    (paket) => Object.values(paket).some((nilai) =>
      String(nilai).toLowerCase().includes(keyword)
    )
  );

  renderPaket(hasil);
});

tampilkanPaket();
