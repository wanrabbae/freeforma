<!-- Koneksi -->
<?php include './koneksi.php'; ?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<!-- Register Form -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center">Daftar Akun</h2>
      <form action="pages/proses_register.php" method="POST">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Daftar</button>
      </form>
      <p class="mt-3 text-center">Sudah punya akun? <a href="login.php?title=Masuk">Masuk</a></p>
    </div>
  </div>
</div>
<!-- Footer -->
<?php include './components/footer.php'; ?>