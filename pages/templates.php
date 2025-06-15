<!-- Koneksi -->
<?php include './koneksi.php'; ?>
<!-- Navbar -->
<?php include './components/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section py-5 bg-primary text-white text-center">
  <div class="container">
    <h1 class="display-4">Template Dokumen Akademik Gratis</h1>
    <p class="lead">Temukan berbagai template dokumen akademik yang siap pakai untuk tugas kuliah, skripsi, dan lainnya.</p>
    <a href="templates.php?title=Templates" class="btn btn-light btn-lg">Lihat Template</a>
  </div>
</section>

<!-- Featured Templates -->
<section class="featured-section py-5 bg-light">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <form class="d-flex align-items-center" method="get" action="templates.php">
          <input
            type="text"
            name="search"
            class="form-control me-2"
            placeholder="Cari template..."
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
            style="max-width: 220px;">
          <select name="sort" class="form-select me-2" style="max-width: 180px;">
            <option value="popular" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'popular') echo 'selected'; ?>>Paling Populer</option>
            <option value="downloaded" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'downloaded') echo 'selected'; ?>>Paling Banyak Diunduh</option>
            <option value="liked" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'liked') echo 'selected'; ?>>Paling Disukai</option>
            <option value="recent" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'recent') echo 'selected'; ?>>Baru Ditambahkan</option>
          </select>
          <select name="category" class="form-select me-2" style="max-width: 200px;">
            <option value="">Semua Kategori</option>
            <option value="Skripsi & Tesis" <?php if (isset($_GET['category']) && $_GET['category'] == 'Skripsi & Tesis') echo 'selected'; ?>>Skripsi & Tesis</option>
            <option value="Jurnal & Artikel" <?php if (isset($_GET['category']) && $_GET['category'] == 'Jurnal & Artikel') echo 'selected'; ?>>Jurnal & Artikel</option>
            <option value="CV Akademik & Resume" <?php if (isset($_GET['category']) && $_GET['category'] == 'CV Akademik & Resume') echo 'selected'; ?>>CV Akademik & Resume</option>
            <option value="Presentasi" <?php if (isset($_GET['category']) && $_GET['category'] == 'Presentasi') echo 'selected'; ?>>Presentasi</option>
            <option value="Lainnya" <?php if (isset($_GET['category']) && $_GET['category'] == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
          </select>
          <button type="submit" class="btn btn-primary">Filter</button>
        </form>
      </div>
    </div>
    <?php
    // Pagination setup
    $perPage = 6;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $perPage;

    // Count total templates
    $countQuery = "SELECT COUNT(*) as total FROM Template WHERE isActive = 1 AND approvalStatus = 'accepted'";
    $countResult = mysqli_query($koneksi, $countQuery);
    $totalTemplates = ($row = mysqli_fetch_assoc($countResult)) ? (int)$row['total'] : 0;
    $totalPages = ceil($totalTemplates / $perPage);

    // Fetch paginated templates
    $sqlQuery = "SELECT
            t.id, 
            t.coverImage, 
            t.templateName, 
            t.fileTemplate, 
            t.downloadCount, 
            t.likeCount, 
            t.category,
            t.createdAt,
            t.deskripsi,  
            u.fullname AS author
          FROM Template t
          LEFT JOIN User u ON t.author = u.id
          WHERE t.isActive = 1 AND approvalStatus = 'accepted'
          ORDER BY t.downloadCount DESC
          LIMIT $perPage OFFSET $offset";

    if (isset($_GET['search']) && !empty($_GET['search'])) {
      $searchTerm = mysqli_real_escape_string($koneksi, $_GET['search']);
      $sqlQuery = "SELECT 
            t.id,
            t.coverImage, 
            t.templateName, 
            t.fileTemplate, 
            t.downloadCount, 
            t.likeCount, 
            t.category,
            t.createdAt,
            t.deskripsi,   
            u.fullname AS author
          FROM Template t
          LEFT JOIN User u ON t.author = u.id
          WHERE t.isActive = 1 AND approvalStatus = 'accepted' AND (t.templateName LIKE '%$searchTerm%' OR u.fullname LIKE '%$searchTerm%')
          ORDER BY t.downloadCount DESC
          LIMIT $perPage OFFSET $offset";
    }

    if (isset($_GET['sort']) && $_GET['sort'] == 'downloaded') {
      $sqlQuery = str_replace('ORDER BY t.downloadCount DESC', 'ORDER BY t.downloadCount DESC, t.templateName ASC', $sqlQuery);
    } elseif (isset($_GET['sort']) && $_GET['sort'] == 'liked') {
      $sqlQuery = str_replace('ORDER BY t.downloadCount DESC', 'ORDER BY t.likeCount DESC, t.templateName ASC', $sqlQuery);
    } elseif (isset($_GET['sort']) && $_GET['sort'] == 'popular') {
      $sqlQuery = str_replace('ORDER BY t.downloadCount DESC', 'ORDER BY t.likeCount + t.downloadCount DESC, t.templateName ASC', $sqlQuery);
    } else if (isset($_GET['sort']) && $_GET['sort'] == 'recent') {
      $sqlQuery = str_replace('ORDER BY t.downloadCount DESC', 'ORDER BY t.createdAt DESC, t.templateName ASC', $sqlQuery);
    }

    if (isset($_GET['category']) && !empty($_GET['category'])) {
      $category = mysqli_real_escape_string($koneksi, $_GET['category']);
      $sqlQuery = str_replace(
        'WHERE t.isActive = 1 AND approvalStatus = \'accepted\'',
        "WHERE t.isActive = 1 AND approvalStatus = 'accepted' AND t.category = '$category'",
        $sqlQuery
      );
    }

    $result = mysqli_query($koneksi, $sqlQuery);

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
    ?>
    <div class="row g-4 mt-4">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-lg-4 col-md-6 mb-4">
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
                <a href="preview-file.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm flex-fill me-2">
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
    <?php if ($totalPages > 1): ?>
      <nav aria-label="Template pagination" class="mt-5">
        <ul class="pagination justify-content-center">
          <li class="page-item<?php if ($page <= 1) echo ' disabled'; ?>">
            <a class="page-link" href="?<?php
                                        $params = $_GET;
                                        $params['page'] = $page - 1;
                                        echo http_build_query($params);
                                        ?>">Previous</a>
          </li>
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item<?php if ($i == $page) echo ' active'; ?>">
              <a class="page-link" href="?<?php
                                          $params = $_GET;
                                          $params['page'] = $i;
                                          echo http_build_query($params);
                                          ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>
          <li class="page-item<?php if ($page >= $totalPages) echo ' disabled'; ?>">
            <a class="page-link" href="?<?php
                                        $params = $_GET;
                                        $params['page'] = $page + 1;
                                        echo http_build_query($params);
                                        ?>">Next</a>
          </li>
        </ul>
      </nav>
    <?php endif; ?>
  </div>
  </div>
</section>

<!-- Footer -->
<?php include './components/footer.php'; ?>