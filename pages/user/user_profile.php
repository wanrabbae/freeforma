<?php

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';

$userData = null;

if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $query = "SELECT * FROM User WHERE id = ?";
  $stmt = $koneksi->prepare($query);
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
  } else {
    echo "User not found.";
  }
} else {
  echo "You are not logged in.";
}

if (isset($_POST['updateProfile'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match!');</script>";
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $profilePhoto = $_FILES['profilePhoto']['name'];

    if ($profilePhoto) {
      $targetDir = '../../assets/users/';
      $uniqueFileName = uniqid() . '-' . basename($profilePhoto);
      $targetFile = $targetDir . $uniqueFileName;
      move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $targetFile);
    } else {
      $profilePhoto = $userData['foto']; // Keep the old photo if no new one is uploaded
    }

    $updateQuery = "UPDATE User SET fullname = ?, email = ?, password = ?, foto = ? WHERE id = ?";
    $updateStmt = $koneksi->prepare($updateQuery);
    $updateStmt->bind_param("ssssi", $fullname, $email, $hashedPassword, $uniqueFileName, $userId);

    if ($updateStmt->execute()) {
      echo "<script>
      alert('Profile updated successfully!');
      window.location.href = './user_profile.php';
      </script>";
      exit();
    } else {
      echo "<script>alert('Error updating profile. Please try again.');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROFILE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="icon" href="../../assets/logo-dark.png" type="image/png">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        <img src="../../assets/logo-white.png" alt="FF" width="30" height="30" class="">
        FreeForma
      </a>

      <div class="d-flex justify-content-between w-100 mr-4">
        <div class="collapse navbar-collapse d-flex justify-content-center mx-3" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item me-3">
              <a class="nav-link" aria-current="page" href="./user_template_generator.php">Template Generator</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link" href="./user_kontribusi_template.php">Kontribusi Template</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link active" href="./user_profile.php">User Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                <i class="fas fa-sign-out-alt"></i> Keluar
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row">
      <div class="col-12">
        <h4 class="fw-bold text-start" style="font-family: 'Poppins', sans-serif;">USER PROFILE</h4>
      </div>
    </div>

    <div class="row align-items-start">
      <div class="col-md-6">
        <div class="card rounded-3 border-3 border-light shadow-sm ">
          <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
              <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <div class="text-center">
                      <img src="<?= isset($userData['foto']) ? '../../assets/users/' . htmlspecialchars($userData['foto']) : '../../assets/users/684d5e5246a78-avatar.png'; ?>" alt="Profile Photo" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
                    </div>
                    <div class="text-center">
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

                <div class="text-center my-4">
                  <a href="../index.php?title=Beranda" class="nav-link text-white text-decoration-underline mb-3">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                  </a>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row my-4">
          <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
              <div class="card-body">
                <h5 class="card-title">Templates</h5>
                <p class="card-text display-4">
                  <?php
                  // Count total templates
                  $query = "SELECT COUNT(*) AS total FROM Template WHERE author = $userId";
                  $result = mysqli_query($koneksi, $query);
                  $row = mysqli_fetch_assoc($result);
                  echo htmlspecialchars($row['total']);
                  ?>
                </p>
                <a href="user_kontribusi_template.php" class="btn btn-light">Lihat</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
              <div class="card-body">
                <h5 class="card-title">Accepted</h5>
                <p class="card-text display-4">
                  <?php
                  // Count active users
                  $query = "SELECT COUNT(*) AS total FROM Template WHERE approvalStatus = 'accepted' AND author = $userId";
                  $result = mysqli_query($koneksi, $query);
                  $row = mysqli_fetch_assoc($result);
                  echo htmlspecialchars($row['total']);
                  ?>
                </p>
                <a href="user_kontribusi_template.php" class="btn btn-light">Lihat</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-dark bg-warning mb-3">
              <div class="card-body">
                <h5 class="card-title">Pending</h5>
                <p class="card-text display-4">
                  <?php
                  // Count active users
                  $query = "SELECT COUNT(*) AS total FROM Template WHERE approvalStatus = 'pending' AND author = $userId";
                  $result = mysqli_query($koneksi, $query);
                  $row = mysqli_fetch_assoc($result);
                  echo htmlspecialchars($row['total']);
                  ?>
                </p>
                <a href="user_kontribusi_template.php" class="btn btn-light">Lihat</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
              <div class="card-body">
                <h5 class="card-title">Rejected</h5>
                <p class="card-text display-4">
                  <?php
                  // Count templates needing approval
                  $query = "SELECT COUNT(*) AS total FROM Template WHERE approvalStatus = 'rejected' AND author = $userId";
                  $result = mysqli_query($koneksi, $query);
                  $row = mysqli_fetch_assoc($result);
                  echo htmlspecialchars($row['total']);
                  ?>
                </p>
                <a href="user_kontribusi_template.php" class="btn btn-light">Lihat</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-4">
      <div class="row">
        <div class="col-12">
          <h4 class="fw-bold text-start" style="font-family: 'Poppins', sans-serif;"> YOUR TOP TEMPLATE</h4>
        </div>
      </div>

      <div class="card-group mt-2 col-12 d-flex justify-content-center gap-3">

        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
      <div class="card-group mt-3 col-12 d-flex justify-content-center gap-3">
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br />
  <?php include './components/footer.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <script>
    // Like button toggle
    document.querySelectorAll('.btn-like').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        this.classList.toggle('liked');
        let icon = this.querySelector('i');
        if (this.classList.contains('liked')) {
          icon.classList.remove('bi-heart');
          icon.classList.add('bi-heart-fill');
        } else {
          icon.classList.remove('bi-heart-fill');
          icon.classList.add('bi-heart');
        }
      });
    });

    // Download button example
    document.querySelectorAll('.btn-download').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        alert('Download dimulai!');
        // Bisa diganti dengan aksi download file asli
      });
    });

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
</body>

</html>