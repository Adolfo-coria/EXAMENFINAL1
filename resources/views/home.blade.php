<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clínica Dental Sonrisa Feliz</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/stilo.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('img/logoo.png') }}" alt="Logo" width="130" height="40">
    </a>
    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link-text-dark" href="#"><b>Inicio</b></a></li>
        <li class="nav-item"><a class="nav-link-text-dark" href="#servicios"><b>Servicios</b></a></li>
        <li class="nav-item"><a class="nav-link-text-dark" href="#equipo"><b>Nuestro Equipo</b></a></li>
        <li class="nav-item"><a class="nav-link-text-dark" href="#contacto"><b>Contacto</b></a></li>
        <li class="nav-item">
          <a class="btn-reservar ms-2 d-flex align-items-center" href="https://wa.me/59172258421" target="_blank">
            <i class="bi bi-whatsapp me-2"></i>
            <b>Contáctanos</b>
          </a>     
        </li>
        @guest
        <li class="nav-item">
          <a class="btn btn-outline-primary ms-2 d-flex align-items-center" href="{{ route('login') }}">
            <i class="bi bi-box-arrow-in-right me-2"></i>
            <b>Ingresar</b>
          </a>
        </li>
        @endguest

        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle ms-2" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item">Cerrar sesión</button>
              </form>
            </li>
          </ul>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<style>
  .custom-toggler .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%2320B2AA' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }
</style>

<div id="carruselTratamientos" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/ortodoncia.jpg') }}" class="d-block w-100" alt="Ortodoncia">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="text-light fw-bold">Ortodoncia</h2>
        <p>Corrección y alineación dental profesional.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/protesis.jpg') }}" class="d-block w-100" alt="Implantes">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="text-light fw-bold">Implantes</h2>
        <p>Implantes dentales seguros y duraderos.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/img3.jpg') }}" class="d-block w-100" alt="Profilaxis">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="text-light fw-bold">Profilaxis</h2>
        <p>Limpiezas dentales profesionales.</p>
      </div>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carruselTratamientos" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carruselTratamientos" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
  </button>
</div>

<section id="servicios" class="py-5">
  <div class="container text-center">
    <h2 class="text-primary-mb-4"><b>Nuestros Servicios</b></h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <i class="bi bi-emoji-smile text-white fs-1"></i>
        <h5>Ortodoncia</h5>
        <p>Alineamos tu sonrisa con técnicas modernas.</p>
      </div>
      <div class="col-md-4 mb-4">
        <i class="bi bi-shield-plus text-white fs-1"></i>
        <h5>Implantes</h5>
        <p>Recupera piezas dentales con procedimientos seguros.</p>
      </div>
      <div class="col-md-4 mb-4">
        <i class="bi bi-heart-pulse text-white fs-1"></i>
        <h5>Profilaxis</h5>
        <p>Limpieza profunda para prevenir enfermedades bucales.</p>
      </div>
    </div>
  </div>
</section>

<section id="equipo" class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="text-primary-mb-4"><b>Conoce a nuestro equipo</b></h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <img src="{{ asset('img/dentista1.jpg') }}" class="img-fluid rounded-circle mb-3" alt="Doctor 1" width="80px" height="80px">
        <h5>Dra. Ana Maria Gonzales</h5>
        <p>Especialista en Ortodoncia</p>
      </div>
      <div class="col-md-4 mb-4">
        <img src="{{ asset('img/dentista2.jpg') }}" class="img-fluid rounded-circle mb-3" alt="Doctor 2" width="80px" height="80px">
        <h5>Dr. Julio Quiroga</h5>
        <p>Implantólogo certificado</p>
      </div>
      <div class="col-md-4 mb-4">
        <img src="{{ asset('img/dentista4.jpg') }}" class="img-fluid rounded-circle mb-3" alt="Doctor 3" width="80px" height="80px">
        <h5>Dra. Juliana Bierhof</h5>
        <p>Higienista dental</p>
      </div>
    </div>
  </div>
</section>

<section id="contacto" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center-text-primary-mb-5"><b>Contáctanos</b></h2>
    <div class="row text-center text-md-start">
      <div class="col-md-6 mb-4 contacto-box">
        <h5><i class="bi bi-telephone-fill text-success me-2"></i>Contactos</h5>
        <p><i class="bi bi-whatsapp text-success"></i>
           <a href="https://wa.me/59172258421" target="_blank">72258421 - 69839031</a></p>
        <p><i class="bi bi-telephone-forward text-secondary"></i>
           <a href="tel:+59133362211"> 479-0725</a></p>
        <p><i class="bi bi-envelope-at text-danger"></i>
           <a href="mailto:info@clinicafoianini.com">info@sonrisafeliz.com</a></p>
      </div>

      <div class="col-md-6 mb-4 contacto-box">
       <h5><i class="bi bi-share-fill me-2"></i>Síguenos</h5>
       <div class="d-flex justify-content-center justify-content-md-start gap-3 fs-4 redes-sociales">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-tiktok"></i></a>
      </div>
      </div>
    </div>
  </div>
</section>

<section id="extras" class="py-5 bg-light">
  <div class="container">
    <div class="row text-center text-md-start">
      <div class="col-md-6 mb-4">
        <h5 class="mb-3"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Ubicación</h5>
        <div class="ratio ratio-16x9">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3793.850985647605!2d-66.16145148518495!3d-17.39360368807343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93e37354d276bdb5%3A0x1f6a1d3f3a5d9a6c!2sCochabamba%2C%20Bolivia!5e0!3m2!1ses-419!2sus!4v1695988777703!5m2!1ses-419!2sus" 
            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <h5 class="mb-3"><i class="bi bi-play-circle-fill text-danger me-2"></i>CLINICA DENTAL SONRISA FELIZ</h5>
        <div class="ratio ratio-16x9">
          <iframe src="https://www.youtube.com/embed/X9J2ea8iNnM" 
            title="Video Promocional" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="footer-custom">
  <p class="mb-0">&copy; Copyright © Sonrisa Felíz 2025</p>
</footer>

<!-- Botón flotante -->
<a href="https://wa.me/59172258421" target="_blank" class="btn-flotante">
  <i class="bi bi-person-fill"></i>
</a>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
