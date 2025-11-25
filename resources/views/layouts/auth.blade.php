<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Clínica Dental Sonrisa Feliz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #20B2AA;
            --dark-primary: #008B8B;
            --light-bg: #f5f9ff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-primary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 100%;
            max-width: 900px;
            padding: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-primary));
            color: white;
            padding: 30px;
            text-align: center;
        }

        .auth-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        .auth-header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .auth-body {
            padding: 40px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .form-section h4 {
            color: var(--dark-primary);
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 18px;
        }

        .form-label {
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(32, 178, 170, 0.25);
        }

        .form-select {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 14px;
        }

        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(32, 178, 170, 0.25);
        }

        .btn {
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--dark-primary);
            border-color: var(--dark-primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 139, 139, 0.3);
        }

        .form-check-input {
            border-color: #ddd;
            width: 18px;
            height: 18px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
            border: none;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: #999;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #ddd;
        }

        .divider span {
            padding: 0 15px;
            font-size: 14px;
        }

        .auth-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .auth-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-link a:hover {
            color: var(--dark-primary);
            text-decoration: underline;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 100px;
            height: auto;
        }

        .row-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .auth-body {
                padding: 20px;
            }

            .row-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1><i class="bi bi-tooth"></i> Sonrisa Feliz</h1>
                <p>Clínica Dental de Confianza</p>
            </div>

            <div class="auth-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>¡Error!</strong>
                        <ul class="mb-0" style="margin-top: 10px;">
                            @foreach($errors->all() as $error)
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
