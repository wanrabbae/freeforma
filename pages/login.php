<?php
include './koneksi.php';
include './components/header.php';

if (isset($_SESSION['user_id'])) {
  echo "<script>alert('Anda sudah masuk sebagai " . htmlspecialchars($_SESSION['role']) . "!');
    window.location.href = 'index.php?title=Beranda';</script>";
  exit();
}

if (isset($_POST['login'])) {
  $email = htmlspecialchars($_POST['email']);
  $password = $_POST['password'];

  // Query to check user credentials
  $query = "SELECT * FROM User WHERE email='$email'";
  $result = mysqli_query($koneksi, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    // Verify password
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['fullname'] = $user['fullname'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['foto'] = $user['foto'];
      $_SESSION['isActive'] = $user['isActive'];
      if ($user['role'] === 'admin') {
        echo "<script>alert('Selamat datang, " . htmlspecialchars($user['fullname']) . "!');
          window.location.href = './admin/index.php';</script>";
      } else {
        echo "<script>alert('Selamat datang, " . htmlspecialchars($user['fullname']) . "!');
          window.location.href = 'index.php?title=Beranda';</script>";
      }
      exit();
    } else {
      $error_message = "Password salah!";
    }
  } else {
    $error_message = "Email tidak ditemukan!";
  }
}

?>

<!-- Login Form -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h2 class="text-center">Masuk</h2>
      <form action="" method="POST">
        <div id="error_info">
          <?php if (isset($error_message)) : ?>
            <div class='alert alert-danger text-center mt-3 p-0'>
              <?= htmlspecialchars($error_message) ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required pattern=".{8,}" title="minimal password 8 karakter">
        </div>
        <button type="submit" class="btn btn-primary w-100" name="login">Masuk</button>
      </form>
      <p class="mt-3 text-center">Belum punya akun? <a href="register.php?title=Masuk">Daftar</a></p>
      <p class="mt-3 text-center"><a href="./forgot-password.php?title=Masuk">Lupa Password?</a></p>
      <p class="mt-3 text-center"><a href="index.php">Kembali ke Beranda</a></p>
    </div>
  </div>
</div>
<!-- Footer -->
<?php include './components/footer.php'; ?>