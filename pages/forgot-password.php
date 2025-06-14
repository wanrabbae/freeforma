<!-- Koneksi -->
<?php include './koneksi.php'; ?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<!-- Forgot Password Form -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h2 class="text-center">Lupa Password</h2>
      <form action="pages/proses_forgot_password.php" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>
      </form>
      <p class="mt-3 text-center">Sudah ingat password? <a href="login.php?title=Masuk">Masuk</a></p>
      <p class="mt-3 text-center"><a href="register.php?title=Masuk">Daftar Akun Baru</a></p>
      <p class="mt-3 text-center"><a href="index.php?title=Beranda">Kembali ke Beranda</a></p>
    </div>
  </div>
</div>
<!-- Footer -->
<?php include './components/footer.php'; ?>
<!-- Scripts -->