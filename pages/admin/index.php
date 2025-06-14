<!-- Koneksi -->
<?php include '../koneksi.php'; ?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<div class="container">
  <div class="row my-4">
    <div class="col-md-4">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Templates</h5>
          <p class="card-text display-4">
            100
          </p>
          <a href="admin_list_template.php" class="btn btn-light">Lihat Templates</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Aktif Users</h5>
          <p class="card-text display-4">
            100
          </p>
          <a href="admin_users.php" class="btn btn-light">Lihat Users</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-danger mb-3">
        <div class="card-body">
          <h5 class="card-title">Need Approval</h5>
          <p class="card-text display-4">
            100
          </p>
          <a href="admin_approval_template.php" class="btn btn-light">Lihat Approval</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h2>Recent Activities</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Action</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>John Doe</td>
            <td>Uploaded Template</td>
            <td>2025-01-01</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jane Smith</td>
            <td>Approved Template</td>
            <td>2025-01-02</td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true
    });
  });
</script>