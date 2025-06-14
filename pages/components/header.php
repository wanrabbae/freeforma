<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FreeForma - <?= isset($_GET['title']) ? $_GET['title'] : 'Template Dokumen Akademik Gratis' ?></title>
  <!-- favicon with png file -->
  <link rel="icon" href="../assets/logo-dark.png" type="image/png">
  <link rel="apple-touch-icon" href="../assets/logo-dark.png">
  <link rel="shortcut icon" href="../assets/logo-dark.png" type="image/png">
  <meta name="description" content="FreeForma menyediakan berbagai template dokumen akademik gratis untuk mahasiswa, dosen, dan peneliti. Temukan template skripsi, tesis, makalah, dan lainnya.">
  <meta name="keywords" content="template, dokumen akademik, skripsi, tesis, makalah, LaTeX, Word, gratis">
  <meta name="author" content="FreeForma Team">
  <meta property="og:title" content="FreeForma - Template Dokumen Akademik Gratis">
  <meta property="og:description" content="Temukan berbagai template dokumen akademik yang siap pakai untuk tugas kuliah, skripsi, dan lainnya.">
  <meta property="og:image" content="https://freeforma.com/assets/images/og-image.jpg">
  <meta property="og:url" content="https://freeforma.com">
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="FreeForma - Template Dokumen Akademik Gratis">
  <meta name="twitter:description" content="Temukan berbagai template dokumen akademik yang siap pakai untuk tugas kuliah, skripsi, dan lainnya.">
  <meta name="twitter:image" content="https://freeforma.com/assets/images/og-image.jpg">
  <meta name="theme-color" content="#007bff">
  <meta name="msapplication-TileColor" content="#007bff">
  <meta name="msapplication-TileImage" content="https://freeforma.com/assets/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="format-detection" content="telephone=no">
  <meta name="google-site-verification" content="your-google-site-verification-code">
  <meta name="yandex-verification" content="your-yandex-verification-code">
  <meta name="msvalidate.01" content="your-bing-site-verification-code">
  <meta name="robots" content="index, follow">
  <meta name="googlebot" content="index, follow">
  <meta name="revisit-after" content="7 days">
  <meta name="language" content="id">
  <meta name="charset" content="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Edu+VIC+WA+NT+Hand+Pre:wght@400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container">
      <div>
        <img src="../assets/logo-white.png" alt="FF" width="30" height="30" class="">
        <a class="navbar-brand" href="index.php" style="font-family: 'Edu VIC WA NT Hand Pre', cursive; font-weight: bold;">FreeForma</a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= !isset($_GET['title']) || $_GET['title'] === 'Beranda' ? 'active' : '' ?>" aria-current="page" href="index.php?title=Beranda">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isset($_GET['title']) && $_GET['title'] === 'Templates' ? 'active' : '' ?>" href="templates.php?title=Templates">Templates</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isset($_GET['title']) && $_GET['title'] === 'Tentang' ? 'active' : '' ?>" href="about.php?title=Tentang">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isset($_GET['title']) && $_GET['title'] === 'Masuk' ? 'active' : '' ?>" href="login.php?title=Masuk">Masuk</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>