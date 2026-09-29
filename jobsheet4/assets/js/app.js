function initNavToggle() {
  const toggleInput = document.getElementById('nav-toggle');
  const toggleButton = document.getElementById('nav-toggle-btn');
  const nav = document.querySelector('header nav');

  if (!nav) return;

  toggleButton?.addEventListener('click', function () {
    nav.classList.toggle('nav-open');
  });

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

function initFormValidation() {
  document.querySelectorAll('form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        form.reportValidity();
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', function () {
  initNavToggle();
  initDeleteButtons();
  initFormValidation();
});
