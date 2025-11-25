<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Clínica Dental Sonrisa Feliz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #20B2AA;
            --dark-primary: #008B8B;
            --light-bg: #f5f9ff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--light-bg);
        }

        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            padding: 20px 0;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar nav a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 25px;
            transition: background-color 0.3s ease;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active {
            background-color: var(--dark-primary);
        }

        .sidebar nav a i {
            margin-right: 10px;
        }

        .header {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: var(--dark-primary);
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #333;
        }

        .main-content {
            flex: 1;
            overflow-y: auto;
        }

        .page-container {
            padding: 30px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 12px 12px 0 0;
        }

        .table {
            background-color: white;
        }

        .table thead {
            background-color: var(--dark-primary);
            color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--dark-primary);
            border-color: var(--dark-primary);
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .dashboard-card i {
            font-size: 35px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .dashboard-card h3 {
            color: var(--dark-primary);
            margin: 10px 0;
        }

        .dashboard-card p {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            margin: 0;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar col-md-3 col-lg-2">
            <h2>Sonrisa Feliz</h2>
            <nav class="flex-column">
                <a href="{{ route('admin.dashboard') }}" class="@if (Route::currentRouteName() == 'admin.dashboard') active @endif">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('patients.index') }}" class="@if (Route::currentRouteName() == 'patients.index') active @endif">
                    <i class="bi bi-person-vcard"></i> Gestión de Pacientes
                </a>
                <a href="{{ route('dentists.index') }}" class="@if (Route::currentRouteName() == 'dentists.index') active @endif">
                    <i class="bi bi-person-badge"></i> Gestión de Odontólogos
                </a>
                <a href="{{ route('appointments.index') }}" class="@if (Route::currentRouteName() == 'appointments.index') active @endif">
                    <i class="bi bi-calendar-check"></i> Citas y Reservas
                </a>
                <a href="{{ route('payments.index') }}" class="@if (Route::currentRouteName() == 'payments.index') active @endif">
                    <i class="bi bi-cash-stack"></i> Pagos y Facturación
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content col-md-9 col-lg-10">
            <header class="header">
                <h1>@yield('page-title')</h1>
                <div class="user-info">
                    <i class="bi bi-person-circle"></i>
                    <span>Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}</span>
                </div>
            </header>

            <div class="page-container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>¡Errores encontrados!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
