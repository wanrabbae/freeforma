<!-- Koneksi -->
<?php include './koneksi.php'; ?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section mt-5">
    <div class="container">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6">
                <h1 class="hero-title">Temukan Template <span class="text-primary">Word & LaTeX</span> Terbaik</h1>
                <p class="hero-subtitle">Ribuan template dokumen akademik siap pakai untuk skripsi, jurnal, laporan, dan CV. Gratis dan open source!</p>
                <div class="hero-search">
                    <div class="input-group input-group-lg">
                        <form action="templates.php" method="get" class="d-flex w-100">
                            <input type="text" class="form-control rounded-0" placeholder="Cari template skripsi, jurnal, CV..." id="heroSearch" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" aria-label="Cari template">
                            <button class="btn btn-primary rounded-0 d-flex align-items-center gap-2 p-3" type="submit">
                                <i class="fas fa-search"></i> <span>Cari</span>
                            </button>
                        </form>
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
                    <img src="../assets/hero.png" alt="Template Documents" class="img-fluid">
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
                        <i class="fa-solid fa-file-powerpoint"></i>
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
            <a href="templates.php?title=Templates&sort=popular" class="btn btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="row g-4">
            <?php
            $query = "
                SELECT 
                    t.coverImage, 
                    t.templateName, 
                    t.fileTemplate, 
                    t.downloadCount, 
                    t.likeCount, 
                    t.category, 
                    u.fullname AS author
                FROM Template t
                LEFT JOIN User u ON t.author = u.id
                WHERE t.isActive = 1 AND approvalStatus = 'accepted'
                ORDER BY t.downloadCount DESC
                LIMIT 3
            ";
            $result = mysqli_query($koneksi, $query);

            $fileTypeBadge = function ($filename) {
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                switch ($ext) {
                    case 'pdf':
                        return '<span class="badge bg-danger">PDF</span>';
                    case 'doc':
                    case 'docx':
                        return '<span class="badge bg-info">Word</span>';
                    case 'tex':
                        return '<span class="badge bg-success">LaTeX</span>';
                    case 'ppt':
                    case 'pptx':
                        return '<span class="badge bg-warning text-dark">PPTX</span>';
                    default:
                        return '<span class="badge bg-secondary">' . strtoupper($ext) . '</span>';
                }
            };

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="template-card">
                        <div class="template-preview" style="width:100%;height:220px;">
                            <img src="../templates/covers/<?php echo htmlspecialchars($row['coverImage']); ?>" alt="Template Preview" class="img-fluid" style="max-width:100%;max-height:100%;">
                        </div>
                        <div class="template-info">
                            <div class="template-overlay">
                                <button class="btn btn-light btn-sm"><i class="fas fa-eye"></i> Preview</button>
                            </div>
                            <div class="template-type">
                                <?php echo $fileTypeBadge($row['fileTemplate']); ?>
                            </div>
                            <h5 class="template-title"><?php echo htmlspecialchars($row['templateName']); ?></h5>
                            <p class="template-author">oleh <strong><?php echo htmlspecialchars($row['author']); ?></strong></p>
                            <div class="template-stats">
                                <span><i class="fas fa-download text-primary"></i> <?php echo (int)$row['downloadCount']; ?></span>
                                <span><i class="fas fa-heart text-danger"></i> <?php echo (int)$row['likeCount']; ?></span>
                                <span><i class="fas fa-tag text-secondary"></i> <?php echo htmlspecialchars($row['category']); ?></span>
                            </div>
                            <div class="template-actions mt-3">
                                <a href="download.php?file=<?php echo urlencode($row['fileTemplate']); ?>" class="btn btn-primary btn-sm flex-fill me-2">
                                    <i class="fas fa-download"></i> Download
                                </a>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
            <a href="templates.php?title=Templates&sort=recent" class="btn btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="row g-3">
            <?php
            $query = "
                SELECT 
                    t.coverImage, 
                    t.templateName, 
                    t.fileTemplate, 
                    t.downloadCount, 
                    t.likeCount, 
                    t.category, 
                    u.fullname AS author
                FROM Template t
                LEFT JOIN User u ON t.author = u.id
                WHERE t.isActive = 1 AND approvalStatus = 'accepted'
                ORDER BY t.createdAt DESC
                LIMIT 3
            ";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="template-card">
                        <div class="template-preview" style="width:100%;height:220px;">
                            <img src="../templates/covers/<?php echo htmlspecialchars($row['coverImage']); ?>" alt="Template Preview" class="img-fluid" style="max-width:100%;max-height:100%;">
                        </div>
                        <div class="template-info">
                            <div class="template-overlay">
                                <button class="btn btn-light btn-sm"><i class="fas fa-eye"></i> Preview</button>
                            </div>
                            <div class="template-type">
                                <?php echo $fileTypeBadge($row['fileTemplate']); ?>
                            </div>
                            <h5 class="template-title"><?php echo htmlspecialchars($row['templateName']); ?></h5>
                            <p class="template-author">oleh <strong><?php echo htmlspecialchars($row['author']); ?></strong></p>
                            <div class="template-stats">
                                <span><i class="fas fa-download text-primary"></i> <?php echo (int)$row['downloadCount']; ?></span>
                                <span><i class="fas fa-heart text-danger"></i> <?php echo (int)$row['likeCount']; ?></span>
                                <span><i class="fas fa-tag text-secondary"></i> <?php echo htmlspecialchars($row['category']); ?></span>
                            </div>
                            <div class="template-actions mt-3">
                                <a href="download.php?file=<?php echo urlencode($row['fileTemplate']); ?>" class="btn btn-primary btn-sm flex-fill me-2">
                                    <i class="fas fa-download"></i> Download
                                </a>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="mb-3">Bergabung dengan Komunitas FreeForma</h2>
        <p class="lead mb-4">Dapatkan akses ke ribuan template dan berkontribusi untuk membantu sesama akademisi</p>
        <div class="cta-buttons">
            <a href="./register.php" class="btn btn-light btn-lg me-3">
                <i class="fas fa-user-plus"></i> Daftar Gratis
            </a>
            <a href="./login.php" class="btn btn-outline-light btn-lg">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include './components/footer.php'; ?>