<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contribution Template</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

  <style>
    body {
      background: #f5f6fa;
    }

    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.6s ease-in-out;
    }

    .fade-in.show {
      opacity: 1;
      transform: translateY(0);
    }

    .highlight {
      background-color: rgb(205, 236, 255) !important;
      transition: background-color 0.6s ease;
    }

    .table img {
      border-radius: 6px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">FreeForma</a>
      <div class="collapse navbar-collapse justify-content-center">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item mx-2">
            <a class="nav-link" href="user_template_generator.php">Generator Template</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link active" href="user_kontribusi_template.php">Contribution Template</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="user_profile.php">Profile</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="fade-in" id="mainContent">
      <h1 class="text-center mb-3 fw-bold">Your Contribution</h1>
      <!-- Diambil dari database {nama anda} -->
      <p class="text-center text-muted">Welcome, <span class="fw-semibold text-primary">[Nama Anda]</span></p>

      <div class="row justify-content-center mb-4">
        <div class="col-md-8">
          <form method="get" class="input-group shadow-sm">
            <input type="text" name="search" id="search" placeholder="Search by name" class="form-control"
              autocomplete="off" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
          </form>
        </div>
      </div>

      <div class="text-center mb-4">
        <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#addTemplateModal">
          <i class="fas fa-plus me-2"></i> Add Contribution Template
        </button>
      </div>


      <div class="table-responsive shadow-sm rounded">
        <table id="templateTable" class="table table-striped table-bordered">
          <thead class="table-light">
            <tr>
              <th>Template Name</th>
              <th>Author</th>
              <th>Deskripsi</th>
              <th>Cover</th>
            </tr>
          </thead>
          <!-- Gunakana Database -->
          <tbody>
            <tr
              class="<?php echo (isset($_GET['search']) && stripos('Template A', $_GET['search']) !== false) ? 'highlight' : ''; ?>">
              <td>Template A</td>
              <td>John Doe</td>
              <td>Deskripsi singkat template A</td>
              <td><img src="cover.jpg" alt="Cover" width="80"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <footer class="bg-dark text-white text-center py-5 mt-5 w-100">
    <div class="container-fluid px-0">
      <div class="row align-items-center mx-0">


        <div class="col-12 col-md-4 mb-3 mb-md-0">
          <h5 class="fw-bold mb-3">Contact Us</h5>
          <a href="https://x.com/username" target="_blank" class="text-white mx-2" title="X / Twitter">
            <i class="bi bi-twitter-x fs-3"></i>
          </a>
          <a href="https://instagram.com/username" target="_blank" class="text-white mx-2" title="Instagram">
            <i class="bi bi-instagram fs-3"></i>
          </a>
          <a href="https://wa.me/6281234567890" target="_blank" class="text-white mx-2" title="WhatsApp">
            <i class="bi bi-whatsapp fs-3"></i>
          </a>
          <a href="tel:+6281234567890" class="text-white mx-2" title="Telepon">
            <i class="bi bi-telephone fs-3"></i>
          </a>
          <a href="mailto:cs@freeforma.com" class="text-white mx-2" title="Email">
            <i class="bi bi-envelope fs-3"></i>
          </a>
        </div>


        <div class="col-12 col-md-4 mb-3 mb-md-0">
          <h5 class="fw-bold mb-3">Service</h5>
          <a href="#" class="text-white text-decoration-none mx-2">FAQ</a> |
          <a href="#" class="text-white text-decoration-none mx-2">Help</a> |
          <a href="#" class="text-white text-decoration-none mx-2">About FreeForma</a>
        </div>

        <!-- Logout -->
        <div class="col-12 col-md-4">
          <a href="logout.php" class="btn btn-danger d-inline-flex align-items-center">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
          </a>
        </div>

      </div>

      <hr class="bg-secondary my-4">

      <div>
        <small class="text-white-50" style="font-size: 1.1rem;">
          &copy; 2025 FreeForma. All rights reserved.
        </small>
      </div>
    </div>
  </footer>


  <script>
    window.addEventListener("load", () => {
      document.getElementById("mainContent").classList.add("show");
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    const params = new URLSearchParams(window.location.search);
    const query = params.get("search");
    if (query) {
      const rows = document.querySelectorAll("#templateTable tbody tr");
      rows.forEach(row => {
        if (row.textContent.toLowerCase().includes(query.toLowerCase())) {
          row.classList.add("highlight");
        }
      });
    }
  </script>
<!-- Modal Form -->
<div class="modal fade" id="addTemplateModal" tabindex="-1" aria-labelledby="addTemplateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="simpan_template.php" enctype="multipart/form-data">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="addTemplateModalLabel">
            Add New Contribution Template
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="template_name" class="form-label">Template Name</label>
            <input type="text" class="form-control" id="template_name" name="template_name" required>
          </div>

          <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
          </div>

          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label for="cover" class="form-label">Cover Image</label>
            <input class="form-control" type="file" id="cover" name="cover" accept="image/*" required>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save Template</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>

</html>