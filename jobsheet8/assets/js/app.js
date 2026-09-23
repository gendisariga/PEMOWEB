function initNavToggle() {
  const toggleBtn = document.getElementById('nav-toggle-btn');
  const nav = document.querySelector('header nav');

  if (!toggleBtn || !nav) return;

  toggleBtn.addEventListener('click', function () {
    nav.classList.toggle('nav-open');
  });
}

function initNavIcons() {
  const icons = {
    '🏠': 'bi-house-door-fill',
    '🧺': 'bi-basket2-fill',
    '👥': 'bi-people-fill',
    '🧾': 'bi-receipt-cutoff',
    '🔐': 'bi-shield-lock-fill',
    '➕': 'bi-plus-circle-fill',
    '↪': 'bi-box-arrow-right'
  };

  document.querySelectorAll('.nav-icon').forEach(function (icon) {
    const iconClass = icons[icon.textContent.trim()];

    if (!iconClass) return;

    icon.className = `bi ${iconClass} nav-icon`;
    icon.textContent = '';
    icon.setAttribute('aria-hidden', 'true');
  });
}

function initAuthLink() {
  const authLink = document.querySelector('.login-nav-link');
  const isLoggedIn = sessionStorage.getItem('laundryLoggedIn') === 'true';

  if (!authLink || !isLoggedIn) return;

  const username = sessionStorage.getItem('laundryUsername') || 'Pengguna';
  authLink.innerHTML = '<i class="bi bi-box-arrow-right nav-icon" aria-hidden="true"></i>Logout';
  authLink.setAttribute('aria-label', `Logout dari akun ${username}`);

  authLink.addEventListener('click', function (event) {
    event.preventDefault();
    sessionStorage.removeItem('laundryLoggedIn');
    sessionStorage.removeItem('laundryUsername');
    window.location.href = authLink.href;
  });
}

function initHapusConfirm() {
  document.addEventListener('click', function (event) {
    const button = event.target.closest('.btn-hapus');

    if (!button) return;

    const konfirmasi = confirm('Apakah Anda yakin ingin menghapus data ini?');

    if (konfirmasi) {
      const baris = button.closest('tr');
      if (baris) baris.remove();
    }
  });
}

function initReceiptButtons() {
  document.addEventListener('click', function (event) {
    const button = event.target.closest('.btn-cetak-struk');

    if (!button) return;

    const cells = button.closest('tr').querySelectorAll('td');
    const receiptWindow = window.open('', '_blank', 'width=420,height=620');

    if (!receiptWindow) return;

    receiptWindow.document.write(`
      <!DOCTYPE html>
      <html lang="id">
      <head>
        <meta charset="UTF-8">
        <title>Struk Klinik Hewan Winadivet</title>
        <style>
          body { font-family: Arial, sans-serif; padding: 24px; color: #172033; }
          h1 { margin: 0 0 4px; color: #0f766e; font-size: 24px; }
          p { margin: 4px 0 18px; color: #64748b; }
          dl { border-top: 1px solid #cbd5e1; border-bottom: 1px solid #cbd5e1; padding: 12px 0; }
          dt { color: #64748b; font-size: 12px; margin-top: 10px; }
          dd { margin: 2px 0 0; font-weight: 700; }
          .thanks { margin-top: 22px; text-align: center; color: #0f766e; font-weight: 700; }
        </style>
      </head>
      <body>
        <h1>Klinik Hewan Winadivet</h1>
        <p>Struk pembayaran klinik hewan</p>
        <dl>
          <dt>Nama pemilik</dt><dd>${cells[1].textContent}</dd>
          <dt>Layanan</dt><dd>${cells[2].textContent}</dd>
          <dt>Jumlah / berat</dt><dd>${cells[3].textContent}</dd>
          <dt>Total pembayaran</dt><dd>${cells[4].textContent}</dd>
          <dt>Status</dt><dd>${cells[5].textContent}</dd>
        </dl>
        <div class="thanks">Terima kasih telah menggunakan Klinik Hewan Winadivet.</div>
      </body>
      </html>
    `);
    receiptWindow.document.close();
    receiptWindow.focus();
    receiptWindow.print();
  });
}

function initTableFilter() {
  const searchBoxes = document.querySelectorAll('.search-box');

  searchBoxes.forEach(function (searchBox) {
    if (!searchBox.dataset.target) return;

    searchBox.addEventListener('keyup', function () {
      const keyword = searchBox.value.toLowerCase();
      const table = document.querySelector(searchBox.dataset.target);

      if (!table) return;

      const rows = table.querySelectorAll('tbody tr');

      rows.forEach(function (row) {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(keyword) ? '' : 'none';
      });
    });
  });
}

function tampilkanError(input, pesan) {
  hapusError(input);

  const span = document.createElement('span');
  span.className = 'error';
  span.textContent = pesan;
  input.insertAdjacentElement('afterend', span);
}

function hapusError(input) {
  const next = input.nextElementSibling;
  if (next && next.classList.contains('error')) {
    next.remove();
  }
}

function initValidasiForm() {
  const form = document.getElementById('form-tambah');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    let valid = true;

    const nama = form.querySelector("[name='nama'], [name='nama_paket']");
    if (nama && nama.value.trim() === '') {
      tampilkanError(nama, 'Field ini wajib diisi.');
      valid = false;
    } else if (nama) {
      hapusError(nama);
    }

    const jenis = form.querySelector("[name='jenis']");
    if (jenis) {
      if (jenis.value.trim() === '') {
        tampilkanError(jenis, 'Jenis laundry wajib diisi.');
        valid = false;
      } else {
        hapusError(jenis);
      }
    }

    const harga = form.querySelector("[name='harga']");
    if (harga) {
      const nilaiHarga = Number(harga.value);
      if (Number.isNaN(nilaiHarga) || nilaiHarga < 0) {
        tampilkanError(harga, 'Harga harus berupa angka valid.');
        valid = false;
      } else {
        hapusError(harga);
      }
    }

    if (!valid) {
      e.preventDefault();
    }
  });
}

document.addEventListener('DOMContentLoaded', function () {
  initNavToggle();
  initNavIcons();
  initAuthLink();
  initHapusConfirm();
  initReceiptButtons();
  initTableFilter();
  initValidasiForm();
});
