<!-- Koneksi -->
<?php include '../koneksi.php'; ?>

<?php
// Create User
if (isset($_POST['createUser'])) {
  $fullname = htmlspecialchars($_POST['fullname']);
  $email = htmlspecialchars($_POST['email']);
  $role = htmlspecialchars($_POST['role']);
  $isActive = htmlspecialchars($_POST['isActive']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

  // Handle file upload
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $targetDir = "../../assets/users/";
    $fileNameUnique = uniqid() . '-' . basename($_FILES["foto"]["name"]);
    $targetFile = $targetDir . $fileNameUnique;
    move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
  } else {
    $targetFile = null; // No file uploaded
    $fileNameUnique = null; // No file uploaded
  }

  // Insert user into database
  $query = "INSERT INTO User (fullname, email, role, isActive, password, foto) VALUES ('$fullname', '$email', '$role', '$isActive', '$password', '$fileNameUnique')";
  mysqli_query($koneksi, $query);

  header("Location: admin_users.php?title=Users");
}

// Update User
if (isset($_POST['updateUser'])) {
  $id = $_POST['id'];
  $fullname = htmlspecialchars($_POST['fullname']);
  $email = htmlspecialchars($_POST['email']);
  $role = htmlspecialchars($_POST['role']);
  $isActive = $_POST['isActive'];

  $queryCheckFile = "SELECT foto FROM User WHERE id='$id'";
  $resultCheckFile = mysqli_query($koneksi, $queryCheckFile);
  $rowCheckFile = mysqli_fetch_assoc($resultCheckFile);

  // Handle file upload
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $targetDir = "../../assets/users/";
    $fileNameUnique = uniqid() . '-' . basename($_FILES["foto"]["name"]);
    $targetFile = $targetDir . $fileNameUnique;

    $oldFile = '../assets/users/' . $rowCheckFile['foto'];
    if (file_exists($oldFile)) {
      unlink($oldFile); // Delete old file
    }
    move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
  } else {
    // If no new file is uploaded, keep the existing file
    $fileNameUnique = $rowCheckFile['foto'];
  }

  // Update user in database
  $query = "UPDATE User SET fullname='$fullname', email='$email', role='$role', isActive='$isActive', foto='$fileNameUnique' WHERE id='$id'";
  mysqli_query($koneksi, $query);

  header("Location: admin_users.php?title=Users");
}

// Delete User
if (isset($_POST['deleteUser'])) {
  $id = $_POST['id'];

  // Check if the user has a profile photo and delete it
  $queryCheckFile = "SELECT foto FROM User WHERE id='$id'";
  $resultCheckFile = mysqli_query($koneksi, $queryCheckFile);
  $rowCheckFile = mysqli_fetch_assoc($resultCheckFile);
  if ($rowCheckFile['foto']) {
    $targetDir = "../../assets/users/";
    $filePath =  $targetDir . $rowCheckFile['foto'];
    if (file_exists($filePath)) {
      unlink($filePath);
    }
  }

  $deletetemplatesQuery = "DELETE FROM Template WHERE author='$id'";
  mysqli_query($koneksi, $deletetemplatesQuery);

  $query = "DELETE FROM User WHERE id='$id'";
  mysqli_query($koneksi, $query);

  header("Location: admin_users.php?title=Users");
}
?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>User Management</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" onclick="openCreateUserModal()">Create User</button>
  </div>
  <table id="usersTable" class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Fullname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM User";
      $result = mysqli_query($koneksi, $query);
      $no = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$no}</td>";
        echo "<td>{$row['fullname']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['role']}</td>";
        echo "<td><span class='badge text-bg-" . ($row['isActive'] ? 'success' : 'danger') . "'>" . ($row['isActive'] ? 'Active' : 'Inactive') . "</span></td>";
        echo "<td>
            <button class='btn btn-sm btn-warning' onclick='openEditUserModal(" . json_encode($row) . ")'>Edit</button>
            <form method='post' action='' style='display:inline;'>
              <input type='hidden' name='id' value='{$row['id']}'>
              <button type='submit' class='btn btn-sm btn-danger' name='deleteUser' onclick=\"return confirm('Apakah anda yaking ingin menghapus user ini? Semua templates terkait user ini akan ikut terhapus.');\">Delete</button>
            </form>
            </td>";
        echo "</tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

<!-- User Modal (Create/Edit) -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel">
  <div class="modal-dialog">
    <form id="userForm" method="post" action="" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="userId">
          <div class="mb-3">
            <label for="fullname" class="form-label">Fullname</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="isActive" class="form-label">Status</label>
            <select class="form-select" id="isActive" name="isActive" required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <div class="mb-3" id="passwordField">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Profile Photo</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <img id="profilePreview" src="#" alt="Profile Photo Preview" class="img-thumbnail mt-2" style="display: none; max-width: 200px;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="saveUserBtn" name="createUser">Save</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- DataTables JS (make sure you have included jQuery and DataTables JS/CSS in your header) -->
<script>
  $(document).ready(function() {
    $('#usersTable').DataTable();
  });

  function openCreateUserModal() {
    $('#userModalLabel').text('Create User');
    $('#userForm')[0].reset();
    $('#userId').val('');
    $('#passwordField').show();
    $('#password').attr('required', 'required');
    $('#profilePreview').hide();
    $('#fullname').val('');
    $('#email').val('');
    $('#userModal').modal('show');
    $('#saveUserBtn').attr('name', 'createUser');
  }

  function openEditUserModal(user) {
    $('#passwordField').show();
    $('#password').removeAttr('required');
    $('#userModalLabel').text('Edit User');
    $('#userId').val(user.id);
    $('#fullname').val(user.fullname);
    $('#email').val(user.email);
    $('#role').val(user.role);
    $('#isActive').val(user.isActive);
    $('#passwordField').hide(); // Hide password field for editing
    $('#userModal').modal('show');
    const preview = document.getElementById('profilePreview');
    if (user.foto) {
      preview.src = '../../assets/users/' + user.foto;
      preview.style.display = 'block';
    } else {
      preview.style.display = 'none';
    }
    $('#saveUserBtn').attr('name', 'updateUser');
  }

  document.getElementById('foto').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('profilePreview');
        preview.src = e.target.result;
        preview.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });

  $('#userModal').on('hidden.bs.modal', function() {
    $('#profilePreview').hide();
    $('#userForm')[0].reset();
  });
</script>