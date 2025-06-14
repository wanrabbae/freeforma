<!-- Koneksi -->
<?php include '../koneksi.php'; ?>

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
        echo "<td>" . ($row['isActive'] ? 'Active' : 'Inactive') . "</td>";
        echo "<td>
            <button class='btn btn-sm btn-warning' onclick='openEditUserModal(" . json_encode($row) . ")'>Edit</button>
            <button class='btn btn-sm btn-danger' onclick='deleteUser({$row['id']})'>Delete</button>
            </td>";
        echo "</tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

<!-- User Modal (Create/Edit) -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="userForm" method="post" action="save_user.php">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="saveUserBtn">Save</button>
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
    $('#userForm').attr('action', 'save_user.php');
    $('#userModal').modal('show');
  }

  function openEditUserModal(user) {
    $('#userModalLabel').text('Edit User');
    $('#userId').val(user.id);
    $('#fullname').val(user.fullname);
    $('#email').val(user.email);
    $('#role').val(user.role);
    $('#isActive').val(user.isActive);
    $('#passwordField').hide(); // Hide password field on edit
    $('#userForm').attr('action', 'update_user.php');
    $('#userModal').modal('show');
  }

  function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
      window.location.href = 'delete_user.php?id=' + id;
    }
  }
</script>