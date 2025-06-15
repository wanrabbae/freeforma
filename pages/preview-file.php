<?php
include './koneksi.php';

if (!isset($_GET['id'])) {
  echo "<script>alert('ID template tidak diberikan.');</script>";
  echo "<script>window.location.href = 'templates.php?title=Templates';</script>";
  exit;
}

$templateId = $_GET['id'];
$sql = "SELECT * FROM Template WHERE id='$templateId'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) === 0) {
  echo "<script>alert('Template tidak ditemukan.');</script>";
  echo "<script>window.location.href = 'templates.php?title=Templates';</script>";
  exit;
}

$template = mysqli_fetch_assoc($result);
$filePath = '../templates/files/' . $template['fileTemplate'];
$fileName = $template['fileTemplate'];
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if (!file_exists($filePath)) {
  echo "<script>alert('File tidak ditemukan.');</script>";
  echo "<script>window.location.href = 'templates.php?title=Templates';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Preview File - <?= htmlspecialchars($template['templateName']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    #pdf-preview canvas {
      width: 100% !important;
      height: auto !important;
    }

    #docx-preview,
    #latex-preview,
    #pptx-preview {
      border: 1px solid #ccc;
      padding: 1rem;
    }
  </style>
</head>

<body class="bg-light">

  <div class="container my-5">
    <h3 class="mb-4">Preview: <?= htmlspecialchars($template['templateName']) ?></h3>

    <div class="d-flex justify-content-end">
      <a href="download-template.php?id=<?= $templateId ?>" class="btn btn-success mb-4">
        <i class="bi bi-download"></i> Download File
      </a>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <?php if ($fileExtension === 'pdf'): ?>
          <div id="pdf-preview"></div>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
          <script>
            const pdfUrl = "<?= $filePath ?>";
            const container = document.getElementById("pdf-preview");

            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
            pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
              for (let page = 1; page <= pdf.numPages; page++) {
                pdf.getPage(page).then(p => {
                  const canvas = document.createElement("canvas");
                  const ctx = canvas.getContext("2d");
                  const viewport = p.getViewport({
                    scale: 1.2
                  });
                  canvas.height = viewport.height;
                  canvas.width = viewport.width;
                  container.appendChild(canvas);
                  p.render({
                    canvasContext: ctx,
                    viewport: viewport
                  });
                });
              }
            });
          </script>

        <?php elseif ($fileExtension === 'docx'): ?>
          <div id="docx-preview">Loading .docx...</div>
          <script src="https://unpkg.com/mammoth/mammoth.browser.min.js"></script>
          <script>
            fetch("<?= $filePath ?>")
              .then(response => response.blob())
              .then(blob => {
                const reader = new FileReader();
                reader.onload = () => {
                  mammoth.convertToHtml({
                      arrayBuffer: reader.result
                    })
                    .then(result => document.getElementById("docx-preview").innerHTML = result.value);
                };
                reader.readAsArrayBuffer(blob);
              });
          </script>

        <?php elseif ($fileExtension === 'pptx'): ?>
          <div id="pptx-preview">Loading .pptx...</div>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
          <script src="https://raw.githubusercontent.com/NaturalIntelligence/fast-xml-parser/refs/heads/master/lib/fxp.min.js"></script>

          <script>
            const pptxContainer = document.getElementById("pptx-preview");

            fetch("http://localhost:8888/freeforma<?= str_replace('..', '', $filePath) ?>")
              .then(res => res.blob())
              .then(blob => {
                const reader = new FileReader();
                reader.onload = async () => {
                  try {
                    const zip = await JSZip.loadAsync(reader.result);
                    const slideFiles = Object.keys(zip.files).filter(f => f.match(/^ppt\/slides\/slide\d+\.xml$/));
                    let html = "<h5>Slide Previews</h5><ul>";

                    // Use fxparser.XMLParser instead of XMLParser directly
                    const fxp2 = new fxp.XMLParser({
                      ignoreAttributes: false
                    });

                    for (let slide of slideFiles) {
                      const xml = await zip.files[slide].async("text");
                      const parsed = fxp2.parse(xml);
                      const shapes = parsed['p:sld']?.['p:cSld']?.['p:spTree']?.['p:sp'];

                      if (Array.isArray(shapes)) {
                        shapes.forEach(shape => {
                          const txt = shape?.['p:txBody']?.['a:p']?.['a:r']?.['a:t'];
                          if (txt) html += `<li>${txt}</li>`;
                        });
                      } else if (shapes) {
                        const txt = shapes?.['p:txBody']?.['a:p']?.['a:r']?.['a:t'];
                        if (txt) html += `<li>${txt}</li>`;
                      }
                    }

                    html += "</ul>";
                    pptxContainer.innerHTML = html;
                  } catch (error) {
                    pptxContainer.innerHTML = "<div class='text-danger'>Gagal memuat isi file .pptx</div>";
                    console.error(error);
                  }
                };
                reader.readAsArrayBuffer(blob);
              })
              .catch(err => {
                pptxContainer.innerHTML = "<div class='text-danger'>Gagal memuat file .pptx</div>";
                console.error(err);
              });
          </script>

        <?php elseif ($fileExtension === 'tex'): ?>
          <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css" rel="stylesheet">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
          <div id="latex-preview">
            <pre><code class="language-latex"><?php echo htmlspecialchars(file_get_contents($filePath)); ?></code></pre>
          </div>

        <?php else: ?>
          <p class="text-muted">Preview untuk file dengan ekstensi .<?= $fileExtension ?> belum didukung.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

</body>

</html>