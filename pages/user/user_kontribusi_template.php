<?php

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';

if (isset($_POST['createTemplate'])) {
  $templateName = mysqli_real_escape_string($koneksi, $_POST['templateName']);
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
  $category = mysqli_real_escape_string($koneksi, $_POST['category']);
  $author = $_SESSION['user_id'];
  $createdAt = date('Y-m-d H:i:s');

  // Handle cover image upload
  $coverImagePath = '';
  if (isset($_FILES['coverImage']) && $_FILES['coverImage']['error'] == 0) {
    $coverDir = '../../templates/covers/';
    if (!is_dir($coverDir)) {
      mkdir($coverDir, 0777, true);
    }
    $coverExt = strtolower(pathinfo($_FILES['coverImage']['name'], PATHINFO_EXTENSION));
    $coverName = uniqid('cover_') . '.' . $coverExt;
    $coverImagePath = $coverDir . $coverName;
    move_uploaded_file($_FILES['coverImage']['tmp_name'], $coverImagePath);
    // Save relative path for DB
    $coverImagePath = $coverName;
  }

  // Handle template file upload
  $fileTemplatePath = '';
  if (isset($_FILES['fileTemplate']) && $_FILES['fileTemplate']['error'] == 0) {
    $fileDir = '../../templates/files/';
    if (!is_dir($fileDir)) {
      mkdir($fileDir, 0777, true);
    }
    $fileExt = strtolower(pathinfo($_FILES['fileTemplate']['name'], PATHINFO_EXTENSION));
    $fileName = uniqid('template_') . '.' . $fileExt;
    $fileTemplatePath = $fileDir . $fileName;
    move_uploaded_file($_FILES['fileTemplate']['tmp_name'], $fileTemplatePath);
    // Save relative path for DB
    $fileTemplatePath = $fileName;
  }

  // Insert into database
  $sql = "INSERT INTO Template (templateName, author, deskripsi, coverImage, fileTemplate, likeCount, downloadCount, category, createdAt)
      VALUES ('$templateName', '$author', '$deskripsi', '$coverImagePath', '$fileTemplatePath', 0, 0, '$category', '$createdAt')";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Template berhasil diupload!');window.location.href='user_kontribusi_template.php';</script>";
    exit();
  } else {
    echo "<script>alert('Gagal mengupload template.');</script>";
  }
}

if (isset($_POST['updateTemplate'])) {
  $templateId = $_POST['templateId'];
  $templateName = mysqli_real_escape_string($koneksi, $_POST['templateName']);
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
  $category = mysqli_real_escape_string($koneksi, $_POST['category']);

  $currentTemplate = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM Template WHERE id='$templateId'"));
  $currentStatus = $currentTemplate['approvalStatus'];

  if ($currentStatus === 'rejected') $currentStatus = 'pending';

  // Handle cover image upload
  $coverImagePath = '';
  if (isset($_FILES['coverImage']) && $_FILES['coverImage']['error'] == 0) {
    $coverDir = '../../templates/covers/';
    if (!is_dir($coverDir)) {
      mkdir($coverDir, 0777, true);
    }
    $coverExt = strtolower(pathinfo($_FILES['coverImage']['name'], PATHINFO_EXTENSION));
    $coverName = uniqid('cover_') . '.' . $coverExt;
    $coverImagePath = $coverDir . $coverName;
    move_uploaded_file($_FILES['coverImage']['tmp_name'], $coverImagePath);
    // Save relative path for DB
    $coverImagePath = $coverName;
  } else {
    $coverImagePath = $currentTemplate['coverImage'];
  }

  // Handle file template upload
  $fileTemplatePath = '';
  if (isset($_FILES['fileTemplate']) && $_FILES['fileTemplate']['error'] == 0) {
    $fileDir = '../../templates/files/';
    if (!is_dir($fileDir)) {
      mkdir($fileDir, 0777, true);
    }
    $fileExt = strtolower(pathinfo($_FILES['fileTemplate']['name'], PATHINFO_EXTENSION));
    $fileName = uniqid('template_') . '.' . $fileExt;
    $fileTemplatePath = $fileDir . $fileName;
    move_uploaded_file($_FILES['fileTemplate']['tmp_name'], $fileTemplatePath);
    // Save relative path for DB
    $fileTemplatePath = $fileName;
  } else {
    $fileTemplatePath = $currentTemplate['fileTemplate'];
  }

  // Update database
  $sql = "UPDATE Template SET 
      templateName='$templateName', 
      deskripsi='$deskripsi', 
      coverImage='$coverImagePath', 
      fileTemplate='$fileTemplatePath',
      category='$category',
      approvalStatus='$currentStatus'
      WHERE id='$templateId'";

  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Template berhasil diperbarui!');window.location.href='user_kontribusi_template.php';</script>";
    exit();
  } else {
    echo "<script>alert('Gagal memperbarui template.');</script>";
  }
}

if (isset($_POST['deleteTemplate'])) {
  $templateId = $_POST['templateId'];
  $sql = "DELETE FROM Template WHERE id='$templateId'";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Template berhasil dihapus!');window.location.href='user_kontribusi_template.php';</script>";
    exit();
  } else {
    echo "<script>alert('Gagal menghapus template.');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontribusi Template</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="icon" href="../../assets/logo-dark.png" type="image/png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <style>
    /* Animasi hover pada card */
    .card-popup {
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .card-popup:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.25);
      z-index: 2;
    }
  </style>
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
              <a class="nav-link active" href="./user_kontribusi_template.php">Kontribusi Template</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link" href="./user_profile.php">User Profile</a>
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
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>List of Templates</h2>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="bi bi-plus"></i> Kontribusi Template
      </button>
    </div>
    <div class="table-responsive">
      <table id="templateTable" class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Cover Image</th>
            <th>Template Name</th>
            <th>Author</th>
            <th>Status</th>
            <th>Aktif</th>
            <th>Download Count</th>
            <th>Tanggal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT t.*, u.fullname AS author 
            FROM Template t 
            LEFT JOIN User u ON t.author = u.id 
            ORDER BY t.createdAt DESC";
          $result = mysqli_query($koneksi, $sql);
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td><img src="../../templates/covers/' . htmlspecialchars($row['coverImage']) . '" alt="Cover" style="width:60px;height:60px;object-fit:cover;"></td>';
            echo '<td>' . htmlspecialchars($row['templateName']) . '</td>';
            echo '<td>' . htmlspecialchars($row['author']) . '</td>';
            echo '<td>';
            if ($row['approvalStatus'] === 'accepted') {
              echo '<span class="badge bg-success">Approved</span>';
            } elseif ($row['approvalStatus'] === 'pending') {
              echo '<span class="badge bg-warning text-dark">Pending</span>';
            } else {
              echo '<span class="badge bg-danger">Rejected</span>';
            }
            echo '</td>';
            echo '<td>';
            if ($row['isActive'] == 1) {
              echo '<span class="badge bg-success">Aktif</span>';
            } else {
              echo '<span class="badge bg-secondary">Tidak Aktif</span>';
            }
            echo '<td>
              <i class="bi bi-download"></i>
            ' . (int)$row['downloadCount'] . '</td>';
            echo '<td>' . htmlspecialchars(date('d M Y', strtotime($row['createdAt']))) . '</td>';
            echo '<td>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editTemplate' . $row['id'] . '">Edit</button>
            <button class="btn btn-warning text-dark btn-sm" data-bs-toggle="modal" data-bs-target="#templateModal' . $row['id'] . '">Detail</button>
            <form action="" method="POST" class="d-inline">
              <input type="hidden" name="templateId" value="' . $row['id'] . '">
              <button type="submit" class="btn btn-danger btn-sm" name="deleteTemplate" onclick="return confirm(\'Are you sure you want to delete this template?\')">Delete</button>
            </form>

            <div class="modal fade" id="templateModal' . $row['id'] . '" tabindex="-1" aria-labelledby="templateModalLabel' . $row['id'] . '" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="templateModalLabel' . $row['id'] . '">' . htmlspecialchars($row['templateName']) . '</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <img src="../../templates/covers/' . htmlspecialchars($row['coverImage']) . '" alt="Cover" class="img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <p><strong>Author:</strong> ' . htmlspecialchars($row['author']) . '</p>
                    <p><strong>Approval Status:</strong> ' . htmlspecialchars($row['approvalStatus']) . '</p>
                    <p><strong>Category:</strong> ' . htmlspecialchars($row['category']) . '</p>
                    <p><strong>Aktif:</strong> ' . ($row['isActive'] ? 'Aktif' : 'Tidak Aktif') . '</p>
                    <p><strong>Like Count:</strong> ' . (int)$row['likeCount'] . '</p>
                    <p><strong>Download Count:</strong> ' . (int)$row['downloadCount'] . '</p>
                    <p><strong>Created At:</strong> ' . htmlspecialchars($row['createdAt']) . '</p>
                    <p><strong>Description:</strong> <hr>' . $row['deskripsi'] . '</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="../download-template.php?id=' . $row['id'] . '" class="btn btn-success"><i class="bi bi-download"></i> Download Template</a>
                  </div>
                  </div>
                </div>
              </div>
              </div>
            </div>

            <!-- Edit Template Modal -->
            <div class="modal fade" id="editTemplate' . $row['id'] . '" tabindex="-1" aria-labelledby="editTemplateLabel' . $row['id'] . '" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editTemplateLabel' . $row['id'] . '">Edit Template</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="templateId" value="' . $row['id'] . '">
                      <div class="mb-3">
                        <label for="editCoverImage' . $row['id'] . '" class="form-label">Cover Image</label>
                        <input class="form-control" type="file" id="editCoverImage' . $row['id'] . '" name="coverImage" accept="image/*">
                        <div class="mt-2">
                          <img id="editCoverPreview' . $row['id'] . '" src="../../templates/covers/' . htmlspecialchars($row['coverImage']) . '" alt="Preview" style="display:block; max-width:200px; max-height:200px; border:1px solid #ddd;" />
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="editTemplateName' . $row['id'] . '" class="form-label">Template Name</label>
                        <input type="text" class="form-control" id="editTemplateName' . $row['id'] . '" name="templateName" value="' . htmlspecialchars($row['templateName']) . '" required>
                      </div>
                      <div class="mb-3">
                        <label for="editDeskripsi' . $row['id'] . '" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi' . $row['id'] . '" name="deskripsi" rows="5" required>' . $row['deskripsi'] . '</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="editCategory' . $row['id'] . '" class="form-label">Kategori</label>
                        <select class="form-select" id="editCategory' . $row['id'] . '" name="category" required>
                          <option value="" disabled>Pilih Kategori</option>
                          <option value="Skripsi & Tesis"' . ($row['category'] == 'Skripsi & Tesis' ? ' selected' : '') . '>Skripsi & Tesis</option>
                          <option value="Jurnal & Artikel"' . ($row['category'] == 'Jurnal & Artikel' ? ' selected' : '') . '>Jurnal & Artikel</option>
                          <option value="CV Akademik & Resume"' . ($row['category'] == 'CV Akademik & Resume' ? ' selected' : '') . '>CV Akademik & Resume</option>
                          <option value="Presentasi"' . ($row['category'] == 'Presentasi' ? ' selected' : '') . '>Presentasi</option>
                          <option value="Lainnya"' . ($row['category'] == 'Lainnya' ? ' selected' : '') . '>Lainnya</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="editFileTemplate' . $row['id'] . '" class="form-label">File Template (docx/pdf/latex)</label>
                        <input class="form-control" type="file" id="editFileTemplate' . $row['id'] . '" name="fileTemplate" accept=".pdf,.docx,.tex,.pptx" readonly>
                        <div class="mt-2" id="editFilePreviewContainer' . $row['id'] . '" style="display:none;">
                          <div id="editFilePreview' . $row['id'] . '"></div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary" name="updateTemplate">Update Template</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <script>
              // ckeditor initialization for edit description
              $(document).ready(function() {
                $("#editDeskripsi' . $row['id'] . '").ckeditor();
              });
              // Cover image preview for edit
              document.getElementById("editCoverImage' . $row['id'] . '").addEventListener("change", function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById("editCoverPreview' . $row['id'] . '");
                if (file && file.type.startsWith("image/")) {
                  const reader = new FileReader();
                  reader.onload = function(ev) {
                    preview.src = ev.target.result;
                    preview.style.display = "block";
                  };
                  reader.readAsDataURL(file);
                } else {
                  preview.src = "#";
                  preview.style.display = "none";
                }
              });
              // File template preview for edit
              document.getElementById("editFileTemplate' . $row['id'] . '").addEventListener("change", function(e) {
                const file = e.target.files[0];
                const previewContainer = document.getElementById("editFilePreviewContainer' . $row['id'] . '");
                const preview = document.getElementById("editFilePreview' . $row['id'] . '");
                preview.innerHTML = "";
                previewContainer.style.display = "none";

                if (!file) return;

                const ext = file.name.split(".").pop().toLowerCase();

                if (ext === "pdf") {
                  // PDF preview using PDF.js
                  const reader = new FileReader();
                  reader.onload = function(ev) {
                    preview.innerHTML = "<canvas id=\"pdfCanvas' . $row['id'] . '" style=\"max-width:100%;border:1px solid #eee;\"></canvas>";
                    previewContainer.style.display = "block";
                    const loadingTask = pdfjsLib.getDocument({
                      data: ev.target.result
                    });
                    loadingTask.promise.then(function(pdf) {
                      pdf.getPage(1).then(function(page) {
                        const scale = 1.2;
                        const viewport = page.getViewport({
                          scale: scale
                        });
                        const canvas = document.getElementById("pdfCanvas' . $row['id'] . '");
                        const context = canvas.getContext("2d");
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        page.render({
                          canvasContext: context,
                          viewport: viewport
                        });
                      });
                    });
                  };
                  reader.readAsArrayBuffer(file);
                } else if (ext === "docx" || ext === "tex") {
                  // DOCX preview using Mammoth.js
                  const reader = new FileReader();
                  reader.onload = function(ev) {
                    mammoth.convertToHtml({ arrayBuffer: ev.target.result })
                      .then(function(result) {
                        preview.innerHTML = result.value; // The generated HTML
                        previewContainer.style.display = "block";
                      })
                      .catch(function(err) {
                        console.error(err);
                      });
                  };
                  reader.readAsArrayBuffer(file);
                } else {
                  alert("Hanya file PDF, DOCX, atau LaTeX yang didukung untuk pratinjau.");
                }
              });
              
            </script>
          </td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Upload New Template Modal -->
  <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="uploadModalLabel">Kontribusi Template Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="coverImage" class="form-label">Cover Image</label>
              <input class="form-control" type="file" id="coverImage" name="coverImage" accept="image/*" required>
              <div class="mt-2">
                <img id="coverPreview" src="#" alt="Preview" style="display:none; max-width:200px; max-height:200px; border:1px solid #ddd;" />
              </div>
            </div>
            <div class="mb-3">
              <label for="templateName" class="form-label">Template Name</label>
              <input type="text" class="form-control" id="templateName" name="templateName" required>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Kategori</label>
              <select class="form-select" id="category" name="category" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="Skripsi & Tesis">Skripsi & Tesis</option>
                <option value="Jurnal & Artikel">Jurnal & Artikel</option>
                <option value="CV Akademik & Resume">CV Akademik & Resume</option>
                <option value="Presentasi">Presentasi</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="fileTemplate" class="form-label">File Template (docx/pdf/latex)</label>
              <input class="form-control" type="file" id="fileTemplate" name="fileTemplate" accept=".pdf,.docx,.tex,.pptx" required>
              <div class="mt-2" id="filePreviewContainer" style="display:none;">
                <div id="filePreview"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" name="createTemplate">Upload Template</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- File preview libraries using: pdf.js and mammoth -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.0-beta.15/mammoth.browser.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/mammoth@1.9.1/lib/index.min.js"></script>
  <!-- WYSIWYG editor libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.0/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.0/adapters/jquery.js"></script>

  <script>
    // Cover image preview
    document.getElementById('coverImage').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const preview = document.getElementById('coverPreview');
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(ev) {
          preview.src = ev.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        preview.src = '#';
        preview.style.display = 'none';
      }
    });

    // File template preview
    document.getElementById('fileTemplate').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const previewContainer = document.getElementById('filePreviewContainer');
      const preview = document.getElementById('filePreview');
      preview.innerHTML = '';
      previewContainer.style.display = 'none';

      if (!file) return;

      const ext = file.name.split('.').pop().toLowerCase();

      if (ext === 'pdf') {
        // PDF preview using PDF.js
        const reader = new FileReader();
        reader.onload = function(ev) {
          preview.innerHTML = '<canvas id="pdfCanvas" style="max-width:100%;border:1px solid #eee;"></canvas>';
          previewContainer.style.display = 'block';
          const loadingTask = pdfjsLib.getDocument({
            data: ev.target.result
          });
          loadingTask.promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
              const scale = 1.2;
              const viewport = page.getViewport({
                scale: scale
              });
              const canvas = document.getElementById('pdfCanvas');
              const context = canvas.getContext('2d');
              canvas.height = viewport.height;
              canvas.width = viewport.width;
              page.render({
                canvasContext: context,
                viewport: viewport
              });
            });
          });
        };
        reader.readAsArrayBuffer(file);
      } else if (ext === 'docx') {
        // DOCX preview using Mammoth.js
        const reader = new FileReader();
        reader.onload = function(ev) {
          mammoth.convertToHtml({
              arrayBuffer: ev.target.result
            })
            .then(function(result) {
              preview.innerHTML = '<div style="max-height:300px;overflow:auto;border:1px solid #eee;padding:10px;">' + result.value + '</div>';
              previewContainer.style.display = 'block';
            });
        };
        reader.readAsArrayBuffer(file);
      } else if (ext === 'tex') {
        // LaTeX preview (show as plain text)
        const reader = new FileReader();
        reader.onload = function(ev) {
          preview.innerHTML = '<pre style="max-height:300px;overflow:auto;border:1px solid #eee;padding:10px;">' +
            ev.target.result.replace(/</g, "&lt;").replace(/>/g, "&gt;") + '</pre>';
          previewContainer.style.display = 'block';
        };
        reader.readAsText(file);
      }
    });

    // handle modal on close 
    $('#uploadModal').on('hidden.bs.modal', function() {
      $(this).find('form')[0].reset();
      $('#coverPreview').hide();
      $('#filePreviewContainer').hide();
      $('#filePreview').empty();
    });
  </script>


  </div>
  <br />
  <?php include './components/footer.php' ?>

  <!-- Modal Popup Card -->
  <div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-dark text-white animate__animated animate__fadeInDown">
        <div class="modal-header border-secondary">
          <h5 class="modal-title" id="cardModalLabel"></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <img src="" id="modalImg" class="img-fluid rounded mb-3 animate__animated animate__zoomIn" alt="..." />
          <p id="modalDesc"></p>
          <div class="d-flex gap-3 justify-content-center mb-2">
            <a href="#" class="text-danger btn-like-modal"><i class="bi bi-heart"></i></a>
            <a href="#" class="text-primary btn-download-modal"><i class="bi bi-download"></i></a>
          </div>
          <small id="modalUpdate"></small>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      $('#templateTable').DataTable();
    });

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

      });
    });

    // Tambahkan class card-popup ke semua card
    document.querySelectorAll('.card-group .card').forEach(function(card) {
      card.classList.add('card-popup');
      card.style.cursor = 'pointer';
      card.setAttribute('data-bs-toggle', 'modal');
      card.setAttribute('data-bs-target', '#cardModal');
    });

    // Popup dinamis
    document.querySelectorAll('.card-popup').forEach(function(card) {
      card.addEventListener('click', function() {
        const imgSrc = card.querySelector('.card-img-top')?.getAttribute('src') || '';
        const title = card.querySelector('.card-title')?.innerText || '';
        const desc = card.querySelector('.card-text')?.innerText || '';
        const update = card.querySelector('small')?.innerText || '';

        document.getElementById('modalImg').src = imgSrc;
        document.getElementById('cardModalLabel').innerText = title;
        document.getElementById('modalDesc').innerText = desc;
        document.getElementById('modalUpdate').innerText = update;
      });
    });

    // Animasi icon like di modal
    document.querySelectorAll('.btn-like-modal').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        this.classList.toggle('liked');
        let icon = this.querySelector('i');
        icon.classList.add('animate__animated', 'animate__bounce');
        setTimeout(() => icon.classList.remove('animate__animated', 'animate__bounce'), 700);
        if (this.classList.contains('liked')) {
          icon.classList.remove('bi-heart');
          icon.classList.add('bi-heart-fill');
        } else {
          icon.classList.remove('bi-heart-fill');
          icon.classList.add('bi-heart');
        }
      });
    });

    // Animasi icon like di card
    document.querySelectorAll('.btn-like').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        this.classList.toggle('liked');
        let icon = this.querySelector('i');
        icon.classList.add('animate__animated', 'animate__bounce');
        setTimeout(() => icon.classList.remove('animate__animated', 'animate__bounce'), 700);
        if (this.classList.contains('liked')) {
          icon.classList.remove('bi-heart');
          icon.classList.add('bi-heart-fill');
        } else {
          icon.classList.remove('bi-heart-fill');
          icon.classList.add('bi-heart');
        }
      });
    });

    // Download button animasi di modal
    document.querySelectorAll('.btn-download-modal').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        let icon = this.querySelector('i');
        icon.classList.add('animate__animated', 'animate__tada');
        setTimeout(() => icon.classList.remove('animate__animated', 'animate__tada'), 700);
        alert('Download dimulai!');
      });
    });

    // Download button animasi di card
    document.querySelectorAll('.btn-download').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        let icon = this.querySelector('i');
        icon.classList.add('animate__animated', 'animate__tada');
        setTimeout(() => icon.classList.remove('animate__animated', 'animate__tada'), 700);
        alert('Download dimulai!');
      });
    });

    // Inisialisasi CKEditor untuk deskripsi
    $(document).ready(function() {
      $('#deskripsi').ckeditor();
    });
  </script>


</body>

</html>