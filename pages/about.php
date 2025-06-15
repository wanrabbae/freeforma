<!-- Koneksi -->
<?php include './koneksi.php'; ?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<!-- About Section -->
<section class="about-section py-5 bg-light">
  <div class="container">
    <h1 class="text-center mb-4">Tentang FreeForma</h1>
    <p class="lead text-center mb-5">FreeForma adalah platform yang menyediakan berbagai template dokumen akademik gratis untuk membantu mahasiswa dalam menyelesaikan tugas kuliah, skripsi, dan lainnya.</p>

    <div class="row">
      <div class="col-md-6">
        <h3>Visi Kami</h3>
        <p>Memberikan akses mudah dan gratis ke berbagai template dokumen akademik yang berkualitas tinggi.</p>
      </div>
      <div class="col-md-6">
        <h3>Misi Kami</h3>
        <p>Membantu mahasiswa di seluruh Indonesia dalam menyelesaikan tugas akademik mereka dengan lebih efisien dan efektif.</p>
      </div>
    </div>

    <div class="mt-5 text-center">
      <a href="templates.php" class="btn btn-primary">Lihat Template</a>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5">
  <div class="container">
    <h2 class="text-center mb-4">Pertanyaan yang Sering Diajukan (FAQ)</h2>
    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Apa itu FreeForma?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            FreeForma adalah platform yang menyediakan berbagai template dokumen akademik gratis untuk mahasiswa, dosen, dan peneliti.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Bagaimana cara mengunduh template?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Anda dapat mengunjungi halaman Templates, memilih template yang diinginkan, dan mengklik tombol unduh.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Apakah saya bisa berkontribusi dengan template saya sendiri?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Tentu! Anda dapat mengirimkan template Anda melalui formulir kontribusi di halaman Templates.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section class="contact-section py-5">
  <div class="container">
    <h2 class="text-center mb-4">Hubungi Kami</h2>
    <p class="text-center mb-5">Jika Anda memiliki pertanyaan atau saran, silakan hubungi kami melalui email di <a href="mailto:alwanrabbae@gmail.com">csfreeforma</a>.</p>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form action="#" method="POST" id="contactForm">
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
          </div>
          <button type="submit" id="kirimPesanEmail" class="btn btn-primary w-100">Kirim Pesan</button>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  // handle form submission
  document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    window.location.href = `mailto:alwanrabbae@gmail.com?subject=Pesan dari ${name}&body=${message} (Dari: ${email})`;

    // Reset form
    this.reset();
  });
</script>

<!-- Footer -->
<?php include './components/footer.php'; ?>