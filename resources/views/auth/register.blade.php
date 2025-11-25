<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Sonrisa Feliz</title>
    <link rel="stylesheet" href="/css/stilo.css">
</head>
<body>
    <div class="container">
        <h1>Registro de usuario</h1>

        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <label for="name">Nombre completo</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required>

            <label for="ci">Carnet de identidad (CI)</label>
            <input id="ci" name="ci" type="text" value="{{ old('ci') }}" required>

            <label for="phone">Número de celular</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required>

            <label for="email">Email (opcional)</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}">

            <label for="role">Tipo de cuenta</label>
            <select id="role" name="role" required>
                <option value="patient" {{ old('role')=='patient' ? 'selected' : '' }}>Paciente</option>
                <option value="dentist" {{ old('role')=='dentist' ? 'selected' : '' }}>Odontólogo</option>
                <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Administrador</option>
            </select>

            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" required>

            <label for="password_confirmation">Confirmar contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required>

            <button type="submit">Registrar</button>
        </form>

        <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
    </div>
</body>
</html>
