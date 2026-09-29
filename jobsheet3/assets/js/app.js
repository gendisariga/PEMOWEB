function initNavToggle() {
  const toggleInput = document.getElementById('nav-toggle');
  const nav = document.querySelector('header nav');

  if (!nav) return;

  toggleInput?.addEventListener('change', function () {
    nav.classList.toggle('nav-open', toggleInput.checked);
  });
}

function initDeleteButtons() {
  document.addEventListener('click', function (event) {
    const button = event.target.closest('button');

    if (!button || button.textContent.trim().toLowerCase() !== 'hapus') return;

    if (confirm('Apakah kamu yakin ingin menghapus data ini?')) {
      button.closest('tr')?.remove();
    }
  });
}

document.addEventListener('DOMContentLoaded', function () {
  initNavToggle();
  initDeleteButtons();
});
