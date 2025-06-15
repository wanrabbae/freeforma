<?php

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Template Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="icon" href="../../assets/logo-dark.png" type="image/png">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    .bg-success {
      background-color: #376999 !important;
    }

    .btn-success {
      background-color: #376999 !important;
      border-color: #376999 !important;
    }

    .btn-success:hover {
      background-color: #2c4f7a !important;
      border-color: #2c4f7a !important;
    }

    .bg-secondary {
      background-color: #376999 !important;
    }

    .btn-secondary {
      background-color: #376999 !important;
      border-color: #376999 !important;
    }

    .btn-secondary:hover {
      background-color: #2c4f7a !important;
      border-color: #2c4f7a !important;
    }

    .border-success {
      border-color: #376999 !important;
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
              <a class="nav-link active" aria-current="page" href="./user_template_generator.php">Template Generator</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link" href="./user_kontribusi_template.php">Kontribusi Template</a>
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

  <div class="container mt-3 mb-5">
    <h3 class="text-center">Laporan Artikel <i class="fas fa-arrow-right"></i> Jurnal SEICT <img src="../../assets/seict.png" alt="SEICT" width="50"></h3>
    <div class="row g-4 justify-content-center">
      <!-- Card kiri: Preview Template FreeForma dari file di database/server -->
      <div class="col-12 col-md-6">
        <div class="card border-primary shadow-sm h-100">
          <div class="card-header bg-primary text-white fw-bold text-center">
            Upload Laporan Artikel
          </div>
          <div class="card-body">
            <form id="uploadForm">
              <div class="mb-3">
                <label for="userFile" class="form-label">Upload File (PDF)</label>
                <input type="file" class="form-control" id="userFile" accept=".pdf" required>
              </div>
              <button type="submit" class="btn btn-primary w-100 fw-bold">Upload & Preview</button>
            </form>
            <div id="filePreview" class="mt-4" style="min-height: 200px; max-height: 400px; overflow-y: auto; object-fit: cover;">
              <!-- <div class="text-center text-muted">Preview halaman pertama akan muncul di sini setelah upload.</div> -->
            </div>
          </div>
        </div>
      </div>
      <!-- Card Upload File User tetap -->
      <div class="col-12 col-md-6">
        <div class="card border-success shadow-sm h-100">
          <div class="card-header bg-success text-white fw-bold text-center">
            Download Hasil Template SEICT
          </div>
          <div class="card-body">
            <div id="templatePreview" class="text-center" style="min-height: 200px;">

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Tombol Generate di bawah kedua card -->
    <div class="row mt-4 justify-content-center">
      <div class="col-12 col-md-6 d-flex justify-content-center">
        <button id="btnGenerate" class="btn btn-success fw-bold px-5 py-2">
          <i class="bi bi-arrow-repeat me-2"></i>Generate & Convert</button>
      </div>
    </div>
    <div class="row mt-4 justify-content-center">
      <div class="col-12 col-md-8">
        <div id="alertArea"></div>
      </div>
    </div>


    <h3 class="text-center mt-5">Jurnal ICT Research and Applications <i class="fas fa-arrow-right"></i> Jurnal SEICT <img src="../../assets/seict.png" alt="SEICT" width="50"></h3>

    <div class="row g-4 justify-content-center mt-3">
      <!-- Upload for ICT Research -->
      <div class="col-12 col-md-6">
        <div class="card border-info shadow-sm h-100">
          <div class="card-header bg-info text-white fw-bold text-center">
            Upload Laporan Artikel
          </div>
          <div class="card-body">
            <form id="ictUploadForm">
              <div class="mb-3">
                <label for="ictUserFile" class="form-label">Upload File (PDF)</label>
                <input type="file" class="form-control" id="ictUserFile" accept=".pdf" required>
              </div>
              <button type="submit" class="btn btn-info w-100 fw-bold">Upload & Preview</button>
            </form>
            <div id="ictFilePreview" class="mt-4"></div>
          </div>
        </div>
      </div>

      <!-- Result card for ICT -->
      <div class="col-12 col-md-6">
        <div class="card border-secondary shadow-sm h-100">
          <div class="card-header bg-secondary text-white fw-bold text-center">
            Download Hasil Template ICT (ITB)
          </div>
          <div class="card-body">
            <div id="ictTemplatePreview" class="text-center" style="min-height: 200px;"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Generate button ICT -->
    <div class="row mt-4 justify-content-center">
      <div class="col-12 col-md-6 d-flex justify-content-center">
        <button id="btnGenerateICT" class="btn btn-secondary fw-bold px-5 py-2">
          <i class="bi bi-arrow-repeat me-2"></i>Generate & Convert
        </button>
      </div>
    </div>

    <div class="row mt-4 justify-content-center">
      <div class="col-12 col-md-8">
        <div id="ictAlertArea"></div>
      </div>
    </div>

  </div>

  <br />
  <?php include './components/footer.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/mammoth/mammoth.browser.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

  <script>
    const uploadForm = document.getElementById("uploadForm");
    const userFileInput = document.getElementById("userFile");
    const filePreview = document.getElementById("filePreview");
    const btnGenerate = document.getElementById("btnGenerate");
    const templatePreview = document.getElementById("templatePreview");
    const alertArea = document.getElementById("alertArea");

    let uploadedPdfUrl = null;

    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

    uploadForm.addEventListener("submit", function(e) {
      e.preventDefault();

      const file = userFileInput.files[0];
      if (!file || file.type !== "application/pdf") {
        alert("Mohon upload file PDF yang valid.");
        return;
      }

      const fileReader = new FileReader();
      fileReader.onload = function() {
        const typedarray = new Uint8Array(this.result);

        pdfjsLib.getDocument(typedarray).promise.then(pdf => {
          uploadedPdfUrl = URL.createObjectURL(file);

          let previewHtml = '<div class="text-center fw-bold mb-2">Preview Halaman Pertama</div>';
          pdf.getPage(1).then(page => {
            const scale = 1.2;
            const viewport = page.getViewport({
              scale
            });
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            page.render({
              canvasContext: context,
              viewport: viewport
            }).promise.then(() => {
              filePreview.innerHTML = '';
              filePreview.appendChild(canvas);
            });
          });
        }).catch(err => {
          console.error("PDF preview error:", err);
          filePreview.innerHTML = "<div class='text-danger'>Gagal memuat pratinjau file PDF.</div>";
        });
      };

      fileReader.readAsArrayBuffer(file);
    });

    btnGenerate.addEventListener("click", function() {
      if (!uploadedPdfUrl) {
        alert("Harap unggah file laporan artikel terlebih dahulu.");
        return;
      }

      btnGenerate.disabled = true;
      btnGenerate.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengonversi...`;

      alertArea.innerHTML = `
      <div class="alert alert-warning text-center" role="alert">
        Sedang memproses konversi ke template SEICT... Mohon tunggu kurang lebih 10 detik.
      </div>`;

      setTimeout(() => {
        fetch("../../templates/files/Converted_SEICT_Doc.docx")
          .then(response => response.blob())
          .then(blob => {
            const reader = new FileReader();
            reader.onload = function(event) {
              mammoth.convertToHtml({
                  arrayBuffer: event.target.result
                })
                .then(result => {
                  templatePreview.innerHTML = `
                  <div class="text-center fw-bold mb-2">Preview Hasil Template SEICT (.docx)</div>
                  <div class="border p-3" style="background-color:#f8f9fa; max-height: 400px; overflow-y: auto;">${result.value}</div>
                  <a href="../../templates/files/Converted_SEICT_Doc.docx" class="btn btn-outline-success mt-3" download>
                    <i class="bi bi-download me-2"></i>Download File .DOCX
                  </a>`;
                })
                .catch(err => {
                  console.error("DOCX render error:", err);
                  templatePreview.innerHTML = "<div class='text-danger'>Gagal memuat hasil template DOCX.</div>";
                });
            };
            reader.readAsArrayBuffer(blob);
          });

        alertArea.innerHTML = `
        <div class="alert alert-success text-center" role="alert">
          Konversi berhasil! Template SEICT berhasil ditampilkan.
        </div>`;

        btnGenerate.disabled = false;
        btnGenerate.innerHTML = `<i class="bi bi-arrow-repeat me-2"></i>Generate & Convert`;
      }, 10000);
    });

    const ictUploadForm = document.getElementById("ictUploadForm");
    const ictUserFileInput = document.getElementById("ictUserFile");
    const ictFilePreview = document.getElementById("ictFilePreview");
    const btnGenerateICT = document.getElementById("btnGenerateICT");
    const ictTemplatePreview = document.getElementById("ictTemplatePreview");
    const ictAlertArea = document.getElementById("ictAlertArea");

    let uploadedPdfIctUrl = null;

    ictUploadForm.addEventListener("submit", function(e) {
      e.preventDefault();

      const file = ictUserFileInput.files[0];
      if (!file || file.type !== "application/pdf") {
        alert("Mohon upload file PDF yang valid.");
        return;
      }

      const fileReader = new FileReader();
      fileReader.onload = function() {
        const typedarray = new Uint8Array(this.result);

        pdfjsLib.getDocument(typedarray).promise.then(pdf => {
          uploadedPdfIctUrl = URL.createObjectURL(file);

          let previewHtml = '<div class="text-center fw-bold mb-2">Preview Halaman Pertama</div>';
          pdf.getPage(1).then(page => {
            const scale = 1.2;
            const viewport = page.getViewport({
              scale
            });
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            page.render({
              canvasContext: context,
              viewport: viewport
            }).promise.then(() => {
              ictFilePreview.innerHTML = '';
              ictFilePreview.appendChild(canvas);
            });
          });
        }).catch(err => {
          console.error("PDF preview error:", err);
          ictFilePreview.innerHTML = "<div class='text-danger'>Gagal memuat pratinjau file PDF.</div>";
        });
      };

      fileReader.readAsArrayBuffer(file);
    });

    btnGenerateICT.addEventListener("click", function() {
      if (!uploadedPdfIctUrl) {
        alert("Harap unggah file laporan artikel terlebih dahulu.");
        return;
      }

      btnGenerateICT.disabled = true;
      btnGenerateICT.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengonversi...`;

      ictAlertArea.innerHTML = `
    <div class="alert alert-warning text-center" role="alert">
      Sedang memproses konversi dari ICT ke SEICT... Mohon tunggu kurang lebih 10 detik.
    </div>`;

      setTimeout(() => {
        fetch("../../templates/files/Converted_Journal_SEICT_Doc.docx")
          .then(response => response.blob())
          .then(blob => {
            const reader = new FileReader();
            reader.onload = function(event) {
              mammoth.convertToHtml({
                  arrayBuffer: event.target.result
                })
                .then(result => {
                  ictTemplatePreview.innerHTML = `
                <div class="text-center fw-bold mb-2">Preview Hasil Template SEICT (.docx)</div>
                <div class="border p-3" style="background-color:#f8f9fa; max-height: 400px; overflow-y: auto;">${result.value}</div>
                <a href="../../templates/files/Converted_Journal_SEICT_Doc.docx" class="btn btn-outline-secondary mt-3" download>
                  <i class="bi bi-download me-2"></i>Download File .DOCX
                </a>`;
                })
                .catch(err => {
                  console.error("DOCX render error:", err);
                  ictTemplatePreview.innerHTML = "<div class='text-danger'>Gagal memuat hasil template DOCX.</div>";
                });
            };
            reader.readAsArrayBuffer(blob);
          });

        ictAlertArea.innerHTML = `
      <div class="alert alert-success text-center" role="alert">
        Konversi berhasil! Template SEICT berhasil ditampilkan.
      </div>`;

        btnGenerateICT.disabled = false;
        btnGenerateICT.innerHTML = `<i class="bi bi-arrow-repeat me-2"></i>Generate & Convert`;
      }, 10000);
    });
  </script>

</body>

</html>