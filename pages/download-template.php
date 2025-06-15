<?php

include './koneksi.php';
if (isset($_GET['id'])) {
  $templateId = $_GET['id'];
  $sql = "SELECT * FROM Template WHERE id='$templateId'";
  $result = mysqli_query($koneksi, $sql);

  if (mysqli_num_rows($result) > 0) {
    $template = mysqli_fetch_assoc($result);
    $filePath = '../templates/files/' . $template['fileTemplate'];

    // Update download count
    $insertDownload = "INSERT INTO TemplateDownloads (userId, templateId, download) VALUES (null, '$templateId', true)";
    mysqli_query($koneksi, $insertDownload);

    if (file_exists($filePath)) {
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
      header('Content-Length: ' . filesize($filePath));
      readfile($filePath);
      exit;
    } else {
      echo "<script>alert('File tidak ditemukan.');</script>";
      echo "<script>window.location.href = 'templates.php?title=Templates';</script>";
    }
  } else {
    echo "<script>alert('Template tidak ditemukan.');</script>";
    echo "<script>window.location.href = 'templates.php?title=Templates';</script>";
  }
} else {
  echo "<script>alert('ID template tidak diberikan.');</script>";
  echo "<script>window.location.href = 'templates.php?title=Templates';</script>";
}
