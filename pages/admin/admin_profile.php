<!-- Koneksi -->
<?php include '../koneksi.php'; ?>

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
          <form>
            <div class="mb-3 text-center">
              <img src="../../assets/logo-dark.png" alt="Profile Photo" class="rounded-circle mb-2" width="100" height="100">
              <div>
                <input class="form-control form-control-sm d-inline-block w-auto" type="file" id="profilePhoto" name="profilePhoto" accept="image/*">
              </div>
            </div>
            <div class="mb-3">
              <label for="fullname" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" value="">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" value="">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Current Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>