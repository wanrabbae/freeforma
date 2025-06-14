<!-- Koneksi -->
<?php include './koneksi.php'; ?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<!-- Login Form -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h2 class="text-center">Masuk</h2>
      <form action="pages/proses_login.php" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>
      <p class="mt-3 text-center">Belum punya akun? <a href="register.php?title=Masuk">Daftar</a></p>
      <p class="mt-3 text-center"><a href="./forgot-password.php?title=Masuk">Lupa Password?</a></p>
      <p class="mt-3 text-center"><a href="index.php">Kembali ke Beranda</a></p>
    </div>
  </div>
</div>
<!-- Footer -->
<?php include './components/footer.php'; ?>