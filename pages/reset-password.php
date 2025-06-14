<?php
include './koneksi.php';
include './components/header.php';
if (!isset($_GET['token'])) {
  echo "<script>alert('Token tidak valid!'); window.location.href = 'login.php?title=Masuk';</script>";
  exit();
}

// reset password
if (isset($_POST['resetPassword'])) {
  $token = htmlspecialchars($_POST['token']);
  $email = htmlspecialchars($_POST['email']);
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // Validasi password
  if ($new_password !== $confirm_password) {
    echo "<script>alert('Password dan Konfirmasi Password tidak cocok.');</script>";
  } else {
    // Hash password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Cek token dan email
    $query = "SELECT * FROM User WHERE email='$email' AND resetPasswordToken='$token'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      // Update password
      $update_query = "UPDATE User SET password='$hashed_password', resetPasswordToken=NULL WHERE email='$email'";
      if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Password berhasil direset! Silakan masuk.'); window.location.href = './login.php?title=Masuk';</script>";
      } else {
        echo "<script>alert('Terjadi kesalahan saat mereset password. Silakan coba lagi.');</script>";
      }
    } else {
      echo "<script>alert('Token atau email tidak valid!');</script>";
    }
  }
}

?>

<!-- Reset Password Form -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h2 class="text-center">Reset Password</h2>
      <form action="" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="new_password" class="form-label">Password Baru</label>
          <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="resetPassword">Reset Password</button>
      </form>
      <p class="mt-3 text-center"><a href="login.php">Kembali ke Masuk</a></p>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include './components/footer.php'; ?>