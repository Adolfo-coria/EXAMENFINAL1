<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión - Sonrisa Feliz</title>
    <link rel="stylesheet" href="/css/stilo.css">
</head>
<body>
    <div class="container">
        <h1>Iniciar sesión</h1>

        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <label for="identifier">Nombre completo / CI / Celular</label>
            <input id="identifier" name="identifier" type="text" value="{{ old('identifier') }}" required>

            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" required>

            <label>
                <input type="checkbox" name="remember"> Recordarme
            </label>

            <button type="submit">Entrar</button>
        </form>

        <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
    </div>
</body>
</html>
