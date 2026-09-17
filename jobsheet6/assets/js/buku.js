const tabelBuku = document.querySelector("#tabel-buku");
const inputCari = document.querySelector("#cari-buku");

let dataBuku = [];

async function tampilkanBuku() {
  try {
    const response = await fetch("../data/buku.json");

    if (!response.ok) {
      throw new Error("Data buku tidak ditemukan");
    }

    dataBuku = await response.json();
    renderBuku(dataBuku);
  } catch (error) {
    tabelBuku.innerHTML = `
      <tr>
        <td colspan="6" style="text-align:center;color:red">
          Gagal memuat data buku
        </td>
      </tr>
    `;
    console.error(error);
  }
}

function renderBuku(data) {
  if (data.length === 0) {
    tabelBuku.innerHTML = `
      <tr>
        <td colspan="6" style="text-align:center">
          Data buku tidak tersedia
        </td>
      </tr>
    `;
    return;
  }

  tabelBuku.innerHTML = data
    .map(
      (buku, index) => `
      <tr>
        <td>${index + 1}</td>
        <td>${buku.judul}</td>
        <td>${buku.pengarang}</td>
        <td>${buku.tahun}</td>
        <td>${buku.stok}</td>
        <td>
          <button class="btn-edit">Edit</button>
          <button class="btn-hapus">Hapus</button>
        </td>
      </tr>
    `
    )
    .join("");
}

inputCari?.addEventListener("input", function () {
  const keyword = this.value.toLowerCase();

  const hasil = dataBuku.filter(
    (buku) =>
      buku.judul.toLowerCase().includes(keyword) ||
      buku.pengarang.toLowerCase().includes(keyword)
  );

  renderBuku(hasil);
});

tampilkanBuku();