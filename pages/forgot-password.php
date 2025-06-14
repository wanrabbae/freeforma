<!-- Koneksi -->
<?php include './koneksi.php'; ?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION['user_id'])) {
  echo "<script>alert('Anda sudah masuk sebagai " . htmlspecialchars($_SESSION['role']) . "!');
    window.location.href = 'index.php?title=Beranda';</script>";
  exit();
}

if (isset($_POST['requestSendEmail'])) {
  $email = htmlspecialchars($_POST['email']);

  // Cek apakah email terdaftar
  $query = "SELECT * FROM User WHERE email='$email'";
  $result = mysqli_query($koneksi, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    // Kirim email reset password
    $user = mysqli_fetch_assoc($result);
    $reset_token = bin2hex(random_bytes(16)); // Generate token
    $host = $_SERVER['HTTP_HOST'];
    $https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
      $host = 'localhost:8888/freeforma';
    }
    $reset_link = "$https$host/pages/reset-password.php?token=$reset_token&title=Masuk";

    // Simpan token ke database (tambahkan kolom reset_token di tabel User)
    $update_query = "UPDATE User SET resetPasswordToken='$reset_token' WHERE email='$email'";
    mysqli_query($koneksi, $update_query);

    require '../vendor/autoload.php'; // Pastikan path ini sesuai dengan lokasi autoload.php
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->Username = "backend2@jexadev.com";
    $mail->Password = "r/O0&wG4FoxZ";
    $mail->setFrom('backend2@jexadev.com', 'FreeForma');
    $mail->addAddress($email);
    $mail->Subject = 'FreeForma - Reset Password';
    $mail->Body = "Klik link berikut untuk mereset password Anda: <a href='$reset_link'>Reset Password</a>";
    $mail->isHTML(true);
    if ($mail->send()) {
      echo "<script>alert('Link reset password telah dikirim ke email Anda.');</script>";
    } else {
      echo "<script>alert('Gagal mengirim email: " . $mail->ErrorInfo . "');</script>";
    }
  } else {
    echo "<script>alert('Email tidak ditemukan!');</script>";
  }
}

?>

<!-- Forgot Password Form -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h2 class="text-center">Lupa Password</h2>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="requestSendEmail">Kirim Link Reset Password</button>
      </form>
      <p class="mt-3 text-center">Sudah ingat password? <a href="login.php?title=Masuk">Masuk</a></p>
      <p class="mt-3 text-center"><a href="register.php?title=Masuk">Daftar Akun Baru</a></p>
      <p class="mt-3 text-center"><a href="index.php?title=Beranda">Kembali ke Beranda</a></p>
    </div>
  </div>
</div>
<!-- Footer -->
<?php include './components/footer.php'; ?>