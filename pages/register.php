<?php
include './koneksi.php';
include './components/header.php';

if (isset($_SESSION['user_id'])) {
  echo "<script>alert('Anda sudah masuk sebagai " . htmlspecialchars($_SESSION['role']) . "!');
    window.location.href = 'index.php?title=Beranda';</script>";
  exit();
}

if (isset($_POST['daftarUser'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validasi password
  if ($password !== $confirm_password) {
    echo "<script>alert('Password dan Konfirmasi Password tidak cocok.');</script>";
  } else {
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $query = "SELECT * FROM User WHERE email='$email'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
      echo "<script>alert('Email sudah terdaftar. Silakan gunakan email lain.');</script>";
    } else {
      // Simpan data user baru ke database
      $insert_query = "INSERT INTO User (fullname, email, password, role, isActive) VALUES ('$nama', '$email', '$hashed_password', 'user', 1)";
      if (mysqli_query($koneksi, $insert_query)) {
        echo "<script>alert('Akun berhasil dibuat! Silakan masuk.'); window.location.href = 'login.php?title=Masuk';</script>";
      } else {
        echo "<script>alert('Terjadi kesalahan saat membuat akun. Silakan coba lagi.');</script>";
      }
    }
  }
}

?>

<!-- Register Form -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center">Daftar Akun</h2>
      <form action="" method="POST">
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
          <input type="password" class="form-control" id="password" name="password" required pattern=".{8,}" title="minimal password 8 karakter">
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required pattern=".{8,}" title="minimal password 8 karakter">
        </div>
        <button type="submit" class="btn btn-primary w-100" name="daftarUser">Daftar</button>
      </form>
      <p class="mt-3 text-center">Sudah punya akun? <a href="login.php?title=Masuk">Masuk</a></p>
    </div>
  </div>
</div>
<!-- Footer -->
<?php include './components/footer.php'; ?>