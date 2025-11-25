<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Panel Odontólogo') - Clínica Sonrisa Feliz</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    * { box-sizing: border-box; }
    
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f4f8;
      color: #333;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
    }

    /* --- Sidebar --- */
    .sidebar {
      background: linear-gradient(180deg, #20B2AA 0%, #008B8B 100%);
      color: white;
      min-height: 100vh;
      padding: 25px 20px;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar h2 {
      font-size: 22px;
      font-weight: 700;
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
      text-decoration: none;
      padding: 12px 15px;
      margin-bottom: 10px;
      border-radius: 10px;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .sidebar a:hover, .sidebar a.active {
      background-color: rgba(255, 255, 255, 0.2);
      transform: scale(1.03);
    }

    /* --- Header superior --- */
    .top-header {
      background-color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .top-header h1 {
      color: #008B8B;
      font-size: 22px;
      font-weight: 600;
      margin: 0;
    }

    .top-header .btn-cerrar {
      background-color: #e53935;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 8px;
      font-size: 14px;
      transition: background 0.3s;
      cursor: pointer;
    }

    .top-header .btn-cerrar:hover {
      background-color: #c62828;
    }

    /* --- Perfil --- */
    .profile-header {
      background-color: white;
      padding: 25px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      transition: all 0.3s ease;
    }

    .profile-header:hover {
      transform: translateY(-5px);
    }

    .profile-header img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 25px;
      border: 3px solid #20B2AA;
    }

    .profile-header h2 {
      margin: 0;
      font-size: 26px;
      color: #20B2AA;
      font-weight: 700;
    }

    .profile-header p {
      margin: 4px 0;
      color: #555;
    }

    /* --- Tarjetas --- */
    .cards-container .card {
      border: none;
      border-radius: 15px;
      background: white;
      padding: 30px 20px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .cards-container .card::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, #20B2AA, #008B8B);
    }

    .cards-container .card:hover {
      transform: translateY(-7px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .cards-container .card a {
      text-decoration: none;
      color: #333;
    }

    .cards-container .card i {
      font-size: 45px;
      color: #20B2AA;
      margin-bottom: 15px;
      transition: transform 0.3s;
    }

    .cards-container .card:hover i {
      transform: scale(1.2);
      color: #008B8B;
    }

    .cards-container .card h5 {
      font-weight: 600;
      color: #008B8B;
      margin-top: 10px;
    }

    footer {
      text-align: center;
      margin-top: 30px;
      color: #666;
      font-size: 14px;
    }

    /* Estilos para alertas */
    .alert-success {
      background-color: #d4edda;
      border-color: #c3e6cb;
      color: #155724;
    }

    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
    }
  </style>

  @yield('styles')
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <aside class="sidebar flex-shrink-0" style="width: 250px; max-width: 100%;">
      <h2>🦷 Sonrisa Feliz</h2>
      <nav class="d-flex flex-column">
        <a href="{{ route('odontologo.dashboard') }}" class="@if(Route::currentRouteName() == 'odontologo.dashboard') active @endif">
          <i class="bi bi-house-door-fill"></i> Inicio
        </a>
        <a href="{{ route('odontologo.historial') }}" class="@if(Route::currentRouteName() == 'odontologo.historial') active @endif">
          <i class="bi bi-folder2-open"></i> Historial Médico
        </a>
        <a href="{{ route('odontologo.diagnosticos') }}" class="@if(Route::currentRouteName() == 'odontologo.diagnosticos') active @endif">
          <i class="bi bi-file-earmark-medical"></i> Diagnóstico
        </a>
        <a href="{{ route('odontologo.tratamientos') }}" class="@if(Route::currentRouteName() == 'odontologo.tratamientos') active @endif">
          <i class="bi bi-heart-pulse"></i> Tratamientos
        </a>
        <a href="{{ route('odontologo.recetas') }}" class="@if(Route::currentRouteName() == 'odontologo.recetas') active @endif">
          <i class="bi bi-prescription2"></i> Recetas
        </a>
        <a href="{{ route('odontologo.controles') }}" class="@if(Route::currentRouteName() == 'odontologo.controles') active @endif">
          <i class="bi bi-calendar-check"></i> Controles
        </a>
        <hr style="background-color: rgba(255,255,255,0.2); margin: 20px 0;">
        <a href="#" onclick="event.preventDefault(); document.getElementById('odontologo-logout-form').submit();" style="color: #ffb3b3;">
          <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1">
      <!-- Top Header -->
      <div class="top-header">
        <h1>@yield('page-title', 'Panel Odontólogo')</h1>
        <div class="d-flex align-items-center gap-3">
          <div style="text-align: right;">
            <div style="font-weight: 600; color: #008B8B;">{{ Auth::user()->name ?? 'Odontólogo' }}</div>
            <div style="font-size: 13px; color: #666;">{{ Auth::user()->email ?? 'correo@clinica.com' }}</div>
          </div>
          <i class="bi bi-person-circle" style="font-size: 32px; color: #20B2AA;"></i>
        </div>
      </div>

      <!-- Main Container -->
      <div class="container-fluid p-4">
        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i><strong>Errores encontrados:</strong>
            <ul class="mb-0 mt-2">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @yield('content')
      </div>

      <!-- Footer -->
      <footer>
        <p>© {{ date('Y') }} Clínica Sonrisa Feliz — Todos los derechos reservados.</p>
      </footer>
    </div>
  </div>

  <!-- Logout Form -->
  <form id="odontologo-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @yield('scripts')
</body>
</html>