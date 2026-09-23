<?php
$title = 'Login | Klinik Hewan Winadivet';
require __DIR__ . '/includes/header.php';
?>
<main><section><h2>Login</h2><form method="post" action="index.php"><div class="mb-3"><label for="username" class="form-label">Username</label><input id="username" name="username" class="form-control" required></div><div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" id="password" name="password" class="form-control" required></div><button class="btn btn-primary" type="submit">Masuk</button></form></section></main>
<?php require __DIR__ . '/includes/footer.php'; ?>
