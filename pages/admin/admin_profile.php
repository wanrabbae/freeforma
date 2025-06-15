<!-- Koneksi -->
<?php include '../koneksi.php'; ?>

<?php
include './session_check.php';

$userData = null;
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $query = "SELECT * FROM User WHERE id = '$userId'";
  $result = mysqli_query($koneksi, $query);
  if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
  }
}

// Update Profile
if (isset($_POST['updateProfile'])) {
  $fullname = htmlspecialchars($_POST['fullname']);
  $email = htmlspecialchars($_POST['email']);
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  // Validate password
  if ($password !== $confirmPassword) {
    echo "<script>alert('Password dan Konfirmasi Password tidak cocok.');</script>";
  } else {
    // Hash the new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload
    if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] == 0) {
      $targetDir = "../../assets/users/";
      $fileNameUnique = uniqid() . '-' . basename($_FILES["profilePhoto"]["name"]);
      $targetFile = $targetDir . $fileNameUnique;
      move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetFile);
    } else {
      // Keep the existing photo if no new file is uploaded
      $fileNameUnique = isset($userData['foto']) ? $userData['foto'] : 'default.png';
    }

    // Update user in database
    $query = "UPDATE User SET fullname='$fullname', email='$email', password='$hashedPassword', foto='$fileNameUnique' WHERE id='$userId'";
    mysqli_query($koneksi, $query);

    echo "<script>alert('Profil berhasil diperbarui.');
      window.location.href = 'admin_profile.php?title=Profile';</script>";
  }
}
?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<div class="container pb-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card mt-5">
        <div class="card-header text-center">
          <h5>User Profile Settings</h5>
        </div>
        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3 text-center">
              <img src="<?= isset($userData['foto']) ? '../../assets/users/' . htmlspecialchars($userData['foto']) : '../../assets/users/default.png'; ?>" alt="Profile Photo" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
              <div>
                <input class="form-control form-control-sm d-inline-block w-auto" type="file" id="profilePhoto" name="profilePhoto" accept="image/*">
              </div>
            </div>
            <div class="mb-3">
              <label for="fullname" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" value="<?= isset($userData['fullname']) ? htmlspecialchars($userData['fullname']) : ''; ?>">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= isset($userData['email']) ? htmlspecialchars($userData['email']) : ''; ?>">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">New Password</label>
              <input type="password" class="form-control" id="password" name="password" pattern=".{8,}" title="minimal password 8 karakter">
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary" name="updateProfile">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('profilePhoto').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.querySelector('.img-fluid').src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>