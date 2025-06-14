<!-- Koneksi -->
<?php include './koneksi.php'; ?>
<!-- Navbar -->
<?php include './components/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section py-5 bg-primary text-white text-center">
  <div class="container">
    <h1 class="display-4">Template Dokumen Akademik Gratis</h1>
    <p class="lead">Temukan berbagai template dokumen akademik yang siap pakai untuk tugas kuliah, skripsi, dan lainnya.</p>
    <a href="templates.php" class="btn btn-light btn-lg">Lihat Template</a>
  </div>
</section>

<!-- Featured Templates -->
<section class="featured-section py-5 bg-light">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="section-title mb-0">Template Terpopuler</h2>
        <p class="text-muted">Template yang paling banyak didownload minggu ini</p>
      </div>
      <a href="templates.php" class="btn btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <div class="template-card">
          <div class="template-preview">
            <img src="assets/images/template-1.jpg" alt="Template Preview" class="img-fluid">
            <div class="template-overlay">
              <button class="btn btn-light btn-sm"><i class="fas fa-eye"></i> Preview</button>
            </div>
          </div>
          <div class="template-info">
            <div class="template-type">
              <span class="badge bg-success">LaTeX</span>
            </div>
            <h5 class="template-title">Template Skripsi Teknik Informatika</h5>
            <p class="template-author">oleh <strong>Dr. Ahmad Yusuf</strong></p>
            <div class="template-stats">
              <span><i class="fas fa-download text-primary"></i> 1.2K</span>
              <span><i class="fas fa-heart text-danger"></i> 89</span>
              <span><i class="fas fa-star text-warning"></i> 4.8</span>
            </div>
            <div class="template-actions mt-3">
              <button class="btn btn-primary btn-sm flex-fill me-2">
                <i class="fas fa-download"></i> Download
              </button>
              <button class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="template-card">
          <div class="template-preview">
            <img src="assets/images/template-2.jpg" alt="Template Preview" class="img-fluid">
            <div class="template-overlay">
              <button class="btn btn-light btn-sm"><i class="fas fa-eye"></i> Preview</button>
            </div>
          </div>
          <div class="template-info">
            <div class="template-type">
              <span class="badge bg-info">Word</span>
            </div>
            <h5 class="template-title">CV Modern Akademik</h5>
            <p class="template-author">oleh <strong>Prof. Siti Nana</strong></p>
            <div class="template-stats">
              <span><i class="fas fa-download text-primary"></i> 956</span>
              <span><i class="fas fa-heart text-danger"></i> 67</span>
              <span><i class="fas fa-star text-warning"></i> 4.6</span>
            </div>
            <div class="template-actions mt-3">
              <button class="btn btn-primary btn-sm flex-fill me-2">
                <i class="fas fa-download"></i> Download
              </button>
              <button class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="template-card">
          <div class="template-preview">
            <img src="assets/images/template-3.jpg" alt="Template Preview" class="img-fluid">
            <div class="template-overlay">
              <button class="btn btn-light btn-sm"><i class="fas fa-eye"></i> Preview</button>
            </div>
          </div>
          <div class="template-info">
            <div class="template-type">
              <span class="badge bg-success">LaTeX</span>
            </div>
            <h5 class="template-title">Paper Konferensi IEEE</h5>
            <p class="template-author">oleh <strong>Dr. Aldo Pratama</strong></p>
            <div class="template-stats">
              <span><i class="fas fa-download text-primary"></i> 743</span>
              <span><i class="fas fa-heart text-danger"></i> 52</span>
              <span><i class="fas fa-star text-warning"></i> 4.7</span>
            </div>
            <div class="template-actions mt-3">
              <button class="btn btn-primary btn-sm flex-fill me-2">
                <i class="fas fa-download"></i> Download
              </button>
              <button class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<?php include './components/footer.php'; ?>