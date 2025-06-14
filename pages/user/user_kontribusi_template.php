<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROFILE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
/* Animasi hover pada card */
.card-popup {
  transition: transform 0.2s, box-shadow 0.2s;
}
.card-popup:hover {
  transform: translateY(-8px) scale(1.03);
  box-shadow: 0 8px 32px 0 rgba(0,0,0,0.25);
  z-index: 2; 
}

</style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">FreeForma</a>

      <div class="d-flex justify-content-between w-100 mr-4">
        <div class="collapse navbar-collapse d-flex justify-content-center mx-3" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item me-3">
              <a class="nav-link" aria-current="page" href="#">Template</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link" href="#">Contribution Template</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">User Profile</a>
            </li>
          </ul>
        </div>

        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
    <div class="container mt-4">
      <div class="row">
        <div class="col-12">
          <h4 class="fw-bold text-start" style="font-family: 'Poppins', sans-serif;"> TRENDING</h4>
        </div>
      </div>

      <div class="card-group mt-2 col-12 d-flex justify-content-center gap-3">

        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
      <div class="card-group mt-3 col-12 d-flex justify-content-center gap-3">
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="container mt-4">
      <div class="row">
        <div class="col-12">
          <h4 class="fw-bold text-start" style="font-family: 'Poppins', sans-serif;"> RECENTLY ADDED</h4>
        </div>
      </div>

      <div class="card-group mt-2 col-12 d-flex justify-content-center gap-3">

        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
      <div class="card-group mt-3 col-12 d-flex justify-content-center gap-3">
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="container mt-4">
      <div class="row">
        <div class="col-12">
          <h4 class="fw-bold text-start" style="font-family: 'Poppins', sans-serif;"> JUST FOR YOU</h4>
        </div>
      </div>

      <div class="card-group mt-2 col-12 d-flex justify-content-center gap-3">

        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
      <div class="card-group mt-3 col-12 d-flex justify-content-center gap-3">
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card rounded-3 border-3 bg-dark shadow-sm text-white">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Template Title</h5>
            <p class="card-text"></p>
            <div class="d-flex gap-3">
              <a href="#" class="text-danger btn-like"><i class="bi bi-heart"></i></a>
              <a href="#" class="text-primary btn-download"><i class="bi bi-download"></i></a>
            </div>
            <p class="card-text text-white"><small class="text-active">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
<footer class="bg-dark text-white text-center py-5 mt-5 w-100" style="position: relative; left: 0; right: 0;">
  <div class="container-fluid px-0">
    <div class="row align-items-center mx-0">
      <div class="col-12 col-md-4 mb-3 mb-md-0">
        <div class="fw-bold mb-2">Contact Us</div>
        <a href="https://x.com/username" target="_blank" class="text-white mx-2" title="X / Twitter">
          <i class="bi bi-twitter-x" style="font-size: 2rem;"></i>
        </a>
        <a href="https://instagram.com/username" target="_blank" class="text-white mx-2" title="Instagram">
          <i class="bi bi-instagram" style="font-size: 2rem;"></i>
        </a>
        <a href="https://wa.me/6281234567890" target="_blank" class="text-white mx-2" title="WhatsApp">
          <i class="bi bi-whatsapp" style="font-size: 2rem;"></i>
        </a>
        <a href="tel:+6281234567890" class="text-white mx-2" title="Telepon">
          <i class="bi bi-telephone" style="font-size: 2rem;"></i>
        </a>
        <a href="mailto:cs@freeforma.com" class="text-white mx-2" title="Customer Service Email">
          <i class="bi bi-envelope" style="font-size: 2rem;"></i>
        </a>
      </div>
      <div class="col-12 col-md-4 mb-3 mb-md-0">
        <div class="fw-bold mb-2">Service</div>
        <div>
          <a href="#" class="text-white mx-2 text-decoration-none">FAQ</a> |
          <a href="#" class="text-white mx-2 text-decoration-none">Help</a> |
          <a href="#" class="text-white mx-2 text-decoration-none">About FreeForma</a>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <button onclick="window.location.href='logout.php'" class="btn btn-success fw-bold px-4 py-2 mt-2">
          <i class="bi bi-box-arrow-right me-2"></i>Get Out Application Now
        </button>
      </div>
    </div>
    <hr class="bg-secondary my-4">
    <small style="font-size:1.1rem;">&copy; 2025 FreeForma. All rights reserved.</small>
  </div>
</footer>

<!-- Modal Popup Card -->
<div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white animate__animated animate__fadeInDown">
      <div class="modal-header border-secondary">
        <h5 class="modal-title" id="cardModalLabel"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="modalImg" class="img-fluid rounded mb-3 animate__animated animate__zoomIn" alt="..." />
        <p id="modalDesc"></p>
        <div class="d-flex gap-3 justify-content-center mb-2">
          <a href="#" class="text-danger btn-like-modal"><i class="bi bi-heart"></i></a>
          <a href="#" class="text-primary btn-download-modal"><i class="bi bi-download"></i></a>
        </div>
        <small id="modalUpdate"></small>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
        
<script>
  // Like button toggle
  document.querySelectorAll('.btn-like').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      this.classList.toggle('liked');
      let icon = this.querySelector('i');
      if(this.classList.contains('liked')) {
        icon.classList.remove('bi-heart');
        icon.classList.add('bi-heart-fill');
      } else {
        icon.classList.remove('bi-heart-fill');
        icon.classList.add('bi-heart');
      }
    });
  });

  // Download button example
  document.querySelectorAll('.btn-download').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      alert('Download dimulai!');
      
    });
  });

  // Tambahkan class card-popup ke semua card
  document.querySelectorAll('.card-group .card').forEach(function(card) {
    card.classList.add('card-popup');
    card.style.cursor = 'pointer';
    card.setAttribute('data-bs-toggle', 'modal');
    card.setAttribute('data-bs-target', '#cardModal');
  });

  // Popup dinamis
  document.querySelectorAll('.card-popup').forEach(function(card) {
    card.addEventListener('click', function() {
      const imgSrc = card.querySelector('.card-img-top')?.getAttribute('src') || '';
      const title = card.querySelector('.card-title')?.innerText || '';
      const desc = card.querySelector('.card-text')?.innerText || '';
      const update = card.querySelector('small')?.innerText || '';

      document.getElementById('modalImg').src = imgSrc;
      document.getElementById('cardModalLabel').innerText = title;
      document.getElementById('modalDesc').innerText = desc;
      document.getElementById('modalUpdate').innerText = update;
    });
  });

  // Animasi icon like di modal
  document.querySelectorAll('.btn-like-modal').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      this.classList.toggle('liked');
      let icon = this.querySelector('i');
      icon.classList.add('animate__animated', 'animate__bounce');
      setTimeout(() => icon.classList.remove('animate__animated', 'animate__bounce'), 700);
      if(this.classList.contains('liked')) {
        icon.classList.remove('bi-heart');
        icon.classList.add('bi-heart-fill');
      } else {
        icon.classList.remove('bi-heart-fill');
        icon.classList.add('bi-heart');
      }
    });
  });

  // Animasi icon like di card
  document.querySelectorAll('.btn-like').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      this.classList.toggle('liked');
      let icon = this.querySelector('i');
      icon.classList.add('animate__animated', 'animate__bounce');
      setTimeout(() => icon.classList.remove('animate__animated', 'animate__bounce'), 700);
      if(this.classList.contains('liked')) {
        icon.classList.remove('bi-heart');
        icon.classList.add('bi-heart-fill');
      } else {
        icon.classList.remove('bi-heart-fill');
        icon.classList.add('bi-heart');
      }
    });
  });

  // Download button animasi di modal
  document.querySelectorAll('.btn-download-modal').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      let icon = this.querySelector('i');
      icon.classList.add('animate__animated', 'animate__tada');
      setTimeout(() => icon.classList.remove('animate__animated', 'animate__tada'), 700);
      alert('Download dimulai!');
    });
  });

  // Download button animasi di card
  document.querySelectorAll('.btn-download').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      let icon = this.querySelector('i');
      icon.classList.add('animate__animated', 'animate__tada');
      setTimeout(() => icon.classList.remove('animate__animated', 'animate__tada'), 700);
      alert('Download dimulai!');
    });
  });
</script>


</body>

</html>