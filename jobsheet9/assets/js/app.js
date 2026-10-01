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
    const button = event.target.closest('.form-hapus button');

    if (!button) return;

    const konfirmasi = confirm('Apakah Anda yakin ingin menghapus data ini?');

    if (!konfirmasi) event.preventDefault();
  });
}

function initReceiptButtons() {
  document.addEventListener('click', function (event) {
    const button = event.target.closest('.btn-cetak-struk');

    if (!button) return;

    const cells = button.closest('tr').querySelectorAll('td');
    const receiptWindow = window.open('', '_blank', 'width=420,height=620');

    if (!receiptWindow) return;

    const escapeHtml = function (value) {
      return value.replace(/[&<>'"]/g, function (character) {
        return {
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          "'": '&#39;',
          '"': '&quot;'
        }[character];
      });
    };

    const transaction = {
      id: button.dataset.id || '-',
      date: button.dataset.tanggal || '-',
      owner: escapeHtml(cells[1].textContent.trim()),
      service: escapeHtml(cells[2].textContent.trim()),
      amount: escapeHtml(cells[3].textContent.trim()),
      total: escapeHtml(cells[4].textContent.trim()),
      status: escapeHtml(cells[5].textContent.trim())
    };

    receiptWindow.document.write(`
      <!DOCTYPE html>
      <html lang="id">
      <head>
        <meta charset="UTF-8">
        <title>Struk Klinik Hewan Winadivet</title>
        <style>
          @page { size: A5; margin: 12mm; }
          * { box-sizing: border-box; }
          body { margin: 0; font-family: Arial, sans-serif; color: #172033; }
          .receipt { max-width: 380px; margin: 0 auto; }
          header { padding-bottom: 14px; border-bottom: 2px solid #0f766e; }
          h1 { margin: 0 0 3px; color: #0f766e; font-size: 22px; }
          header p { margin: 0; color: #64748b; font-size: 12px; }
          .meta { display: flex; justify-content: space-between; gap: 12px; margin: 14px 0; color: #64748b; font-size: 11px; }
          dl { margin: 0; border-top: 1px solid #cbd5e1; border-bottom: 1px solid #cbd5e1; padding: 10px 0; }
          dt { margin-top: 9px; color: #64748b; font-size: 11px; }
          dt:first-child { margin-top: 0; }
          dd { margin: 2px 0 0; font-weight: 700; font-size: 14px; }
          .total { display: flex; justify-content: space-between; margin-top: 14px; font-size: 16px; font-weight: 700; }
          .thanks { margin-top: 24px; text-align: center; color: #0f766e; font-size: 12px; font-weight: 700; }
          @media print { .receipt { max-width: none; } }
        </style>
      </head>
      <body>
        <article class="receipt">
          <header><h1>Klinik Hewan Winadivet</h1><p>Struk pembayaran kunjungan klinik</p></header>
          <div class="meta"><span>No. transaksi: ${transaction.id}</span><span>${transaction.date}</span></div>
          <dl>
            <dt>Nama pemilik</dt><dd>${transaction.owner}</dd>
            <dt>Layanan</dt><dd>${transaction.service}</dd>
            <dt>Berat / jumlah</dt><dd>${transaction.amount}</dd>
            <dt>Status</dt><dd>${transaction.status}</dd>
          </dl>
          <div class="total"><span>Total pembayaran</span><span>${transaction.total}</span></div>
          <div class="thanks">Terima kasih telah menggunakan layanan kami.</div>
        </article>
      </body>
      </html>
    `);
    receiptWindow.document.close();
    receiptWindow.setTimeout(function () {
      receiptWindow.focus();
      receiptWindow.print();
    }, 300);
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
