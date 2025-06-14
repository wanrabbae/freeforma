<!-- Koneksi -->
<?php
include '../koneksi.php';

include './session_check.php';
// Logout process
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: ../login.php?title=Masuk");
  exit();
}

?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<div class="container">
  <div class=" my-4">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang <strong><?= htmlspecialchars($_SESSION['fullname']) ?></strong>, Anda masuk sebagai <strong><?= htmlspecialchars($_SESSION['role']) ?></strong>.</p>
  </div>

  <div class="row my-4">
    <div class="col-md-4">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Templates</h5>
          <p class="card-text display-4">
            <?php
            // Count total templates
            $query = "SELECT COUNT(*) AS total FROM Template WHERE approvalStatus = 'accepted'";
            $result = mysqli_query($koneksi, $query);
            $row = mysqli_fetch_assoc($result);
            echo htmlspecialchars($row['total']);
            ?>
          </p>
          <a href="admin_list_template.php?title=Templates" class="btn btn-light">Lihat Templates</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">User Aktif</h5>
          <p class="card-text display-4">
            <?php
            // Count active users
            $query = "SELECT COUNT(*) AS total FROM User WHERE isActive = 1";
            $result = mysqli_query($koneksi, $query);
            $row = mysqli_fetch_assoc($result);
            echo htmlspecialchars($row['total']);
            ?>
          </p>
          <a href="admin_users.php?title=Users" class="btn btn-light">Lihat Users</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-danger mb-3">
        <div class="card-body">
          <h5 class="card-title">Need Approval</h5>
          <p class="card-text display-4">
            <?php
            // Count templates needing approval
            $query = "SELECT COUNT(*) AS total FROM Template WHERE approvalStatus = 'pending'";
            $result = mysqli_query($koneksi, $query);
            $row = mysqli_fetch_assoc($result);
            echo htmlspecialchars($row['total']);
            ?>
          </p>
          <a href="admin_approval_template.php?title=Approval Template" class="btn btn-light">Lihat Approval</a>
        </div>
      </div>
    </div>
  </div>

  <div class="text-center my-4">
    <a href="../index.php?title=Beranda" class="nav-link text-primary mb-3">
      <i class="fas fa-arrow-left"></i>
      Kembali ke Beranda
    </a>
    <form action="" method="POST">
      <button type="submit" class="btn btn-danger" name="logout" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
        <i class="fas fa-sign-out-alt"></i> Keluar
      </button>
    </form>
  </div>
</div>