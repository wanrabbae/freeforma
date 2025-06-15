<?php

include './koneksi.php';
if (isset($_GET['id'])) {
  $templateId = $_GET['id'];
  $sql = "SELECT * FROM Template WHERE id='$templateId'";
  $result = mysqli_query($koneksi, $sql);

  if (mysqli_num_rows($result) > 0) {
    $template = mysqli_fetch_assoc($result);
    $filePath = '../templates/files/' . $template['fileTemplate'];

    if (file_exists($filePath)) {
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
      header('Content-Length: ' . filesize($filePath));
      readfile($filePath);
      exit;
    } else {
      echo "File tidak ditemukan.";
    }
  } else {
    echo "Template tidak ditemukan.";
  }
} else {
  echo "ID template tidak diberikan.";
}
