<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = trim($_POST['username'] ?? '');

	if ($username !== '' && trim($_POST['password'] ?? '') !== '') {
		$_SESSION['clinic_logged_in'] = true;
		$_SESSION['clinic_username'] = $username;
		header('Location: index.php');
		exit;
	}
}

$title = 'Login | Klinik Hewan Winadivet';
require __DIR__ . '/includes/header.php';
?>
<main class="login-page">
	<section class="login-shell login-card">
		<a class="login-brand" href="index.php">Klinik Hewan Winadivet</a>
		<div class="login-icon"><i class="bi bi-heart-pulse-fill" aria-hidden="true"></i></div>
		<h1>Selamat Datang</h1>
		<p class="login-intro">Masuk untuk mengelola data pasien dan layanan klinik.</p>
		<form class="login-form" method="post" action="login.php">
			<label for="username">Username</label>
			<input id="username" name="username" autocomplete="username" required>
			<label for="password">Password</label>
			<input id="password" name="password" type="password" autocomplete="current-password" required>
			<button class="login-submit" type="submit"><i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Masuk ke Dashboard</button>
		</form>
		<a class="login-back" href="index.php"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke beranda</a>
	</section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
