<?php include 'pages/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FreeForma - Template Dokumen Akademik Gratis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php include 'pages/navbar.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
      <div class="row align-items-center min-vh-75">
          <div class="col-lg-6">
              <h1 class="hero-title">Temukan Template <span class="text-primary">Word & LaTeX</span> Terbaik</h1>
              <p class="hero-subtitle">Ribuan template dokumen akademik siap pakai untuk skripsi, jurnal, laporan, dan CV. Gratis dan open source!</p>
              <div class="hero-search">
                  <div class="input-group input-group-lg">
                      <input type="text" class="form-control" placeholder="Cari template skripsi, jurnal, CV..." id="heroSearch">
                      <button class="btn btn-primary" type="button">
                          <i class="fas fa-search"></i> Cari
                      </button>
                  </div>
              </div>
              <div class="hero-stats mt-4">
                  <div class="row text-center">
                      <div class="col-4">
                          <h4 class="text-primary mb-0">500+</h4>
                          <small class="text-muted">Template</small>
                      </div>
                      <div class="col-4">
                          <h4 class="text-primary mb-0">10K+</h4>
                          <small class="text-muted">Download</small>
                      </div>
                      <div class="col-4">
                          <h4 class="text-primary mb-0">1K+</h4>
                          <small class="text-muted">Pengguna</small>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="hero-image">
                  <img src="assets/images/hero-illustration.svg" alt="Template Documents" class="img-fluid">
              </div>
          </div>
      </div>
  </div>
</section>

<!-- Categories Section -->
<section class="categories-section py-5">
  <div class="container">
      <div class="text-center mb-5">
          <h2 class="section-title">Kategori Template</h2>
          <p class="section-subtitle">Pilih kategori sesuai kebutuhan akademik Anda</p>
      </div>
      <div class="row g-4">
          <div class="col-lg-3 col-md-6">
              <div class="category-card">
                  <div class="category-icon">
                      <i class="fas fa-graduation-cap"></i>
                  </div>
                  <h5>Skripsi & Tesis</h5>
                  <p>Template lengkap untuk penulisan skripsi dan tesis</p>
                  <span class="badge bg-primary">120+ Template</span>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="category-card">
                  <div class="category-icon">
                      <i class="fas fa-file-alt"></i>
                  </div>
                  <h5>Jurnal & Artikel</h5>
                  <p>Format jurnal ilmiah dan artikel penelitian</p>
                  <span class="badge bg-primary">85+ Template</span>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="category-card">
                  <div class="category-icon">
                      <i class="fas fa-user-tie"></i>
                  </div>
                  <h5>CV & Resume</h5>
                  <p>Template CV akademik dan profesional</p>
                  <span class="badge bg-primary">60+ Template</span>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="category-card">
                  <div class="category-icon">
                      <i class="fas fa-presentation"></i>
                  </div>
                  <h5>Presentasi</h5>
                  <p>Template slide untuk presentasi akademik</p>
                  <span class="badge bg-primary">45+ Template</span>
              </div>
          </div>
      </div>
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

<!-- Recently Added -->
<section class="recent-section py-5">
  <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
              <h2 class="section-title mb-0">Baru Ditambahkan</h2>
              <p class="text-muted">Template terbaru dari kontributor kami</p>
          </div>
          <a href="templates.php?sort=newest" class="btn btn-outline-primary">Lihat Semua</a>
      </div>
      <div class="row g-3">
          <div class="col-lg-6">
              <div class="template-card-horizontal">
                  <div class="template-preview-small">
                      <img src="assets/images/template-4.jpg" alt="Template Preview">
                  </div>
                  <div class="template-info">
                      <div class="d-flex justify-content-between align-items-start">
                          <div>
                              <span class="badge bg-info mb-2">Word</span>
                              <h6 class="template-title">Proposal Penelitian</h6>
                              <p class="template-author mb-1">oleh <strong>Dr. Dina Marlina</strong></p>
                              <small class="text-muted">2 hari yang lalu</small>
                          </div>
                          <div class="template-stats-small">
                              <small><i class="fas fa-download"></i> 23</small>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="template-card-horizontal">
                  <div class="template-preview-small">
                      <img src="assets/images/template-5.jpg" alt="Template Preview">
                  </div>
                  <div class="template-info">
                      <div class="d-flex justify-content-between align-items-start">
                          <div>
                              <span class="badge bg-success mb-2">LaTeX</span>
                              <h6 class="template-title">Laporan Praktikum</h6>
                              <p class="template-author mb-1">oleh <strong>Rizki Ananda</strong></p>
                              <small class="text-muted">1 minggu yang lalu</small>
                          </div>
                          <div class="template-stats-small">
                              <small><i class="fas fa-download"></i> 156</small>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white">
  <div class="container text-center">
      <h2 class="mb-3">Bergabung dengan Komunitas FreeForma</h2>
      <p class="lead mb-4">Dapatkan akses ke ribuan template dan berkontribusi untuk membantu sesama akademisi</p>
      <div class="cta-buttons">
          <a href="pages/register.php" class="btn btn-light btn-lg me-3">
              <i class="fas fa-user-plus"></i> Daftar Gratis
          </a>
          <a href="pages/login.php" class="btn btn-outline-light btn-lg">
              <i class="fas fa-sign-in-alt"></i> Masuk
          </a>
      </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer py-5 bg-dark text-white">
  <div class="container">
      <div class="row g-4">
          <div class="col-lg-4">
              <h5 class="mb-3">FreeForma</h5>
              <p>Platform open source untuk berbagi template dokumen akademik. Membantu mahasiswa dan dosen dalam penulisan karya ilmiah.</p>
              <div class="social-links">
                  <a href="#" class="text-white me-3"><i class="fab fa-github"></i></a>
                  <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                  <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
              </div>
          </div>
          <div class="col-lg-4">
              <h5 class="mb-3">Kategori</h5>
              <ul class="list-unstyled">
                  <li><a href="#" class="text-white">Skripsi & Tesis</a></li>
                  <li><a href="#" class="text-white">Jurnal & Artikel</a></li>
                  <li><a href="#" class="text-white">CV & Resume</a></li>
                  <li><a href="#" class="text-white">Presentasi</a></li>
              </ul>
          </div>
          <div class="col-lg-4">
              <h5 class="mb-3">Hubungi Kami</h5>
              <ul class="list-unstyled">
                  <li><a href="#" class="text-white">Tentang Kami</a></li>
                  <li><a href="#" class="text-white">Syarat & Ketentuan</a></li>
                  <li><a href="#" class="text-white">Kebijakan Privasi</a></li>
                  <li><a href="#" class="text-white">FAQ</a></li>
              </ul>
          </div>
      </div>
      <div class="text-center mt-5">
          <p class="mb-1">© 2025 FreeForma. Semua Hak Dilindungi.</p>
          <p class="small">Dibuat dengan ❤️ oleh Mahasiswa Indonesia</p>
      </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
