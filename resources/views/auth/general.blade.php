@extends('layouts.auth')

@section('title', 'Acceso - Sonrisa Feliz')

@section('content')
<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="form-section">
            <h4><i class="bi bi-box-arrow-in-right"></i> Iniciar sesión</h4>

            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf

                <div class="mb-3">
                    <label for="identifier" class="form-label">Nombre completo / CI / Celular</label>
                    <input id="identifier" name="identifier" type="text" class="form-control" value="{{ old('identifier') }}" placeholder="Ej: Juan Perez, 12345678, 71234567" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Tu contraseña" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>

                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-key-fill"></i> Entrar</button>
            </form>

            <div class="auth-link">
                ¿No tienes cuenta? <a href="#registroForm">Regístrate aquí</a>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="divider" style="margin: 0 0 30px 0;">
            <span>o</span>
        </div>

        <div class="form-section" id="registroForm">
            <h4><i class="bi bi-person-plus"></i> Registrar nuevo usuario</h4>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="row-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre completo</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Tu nombre completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="ci" class="form-label">C.I. (Carnet de Identidad)</label>
                        <input id="ci" name="ci" type="text" class="form-control" value="{{ old('ci') }}" placeholder="Ej: 12345678" required>
                    </div>
                </div>

                <div class="row-form">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Celular</label>
                        <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone') }}" placeholder="Ej: 71234567" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email (opcional)</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="tu@email.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Tipo de cuenta</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="patient" {{ old('role')=='patient' ? 'selected' : '' }}>
                            <i class="bi bi-person-vcard"></i> Paciente
                        </option>
                        <option value="dentist" {{ old('role')=='dentist' ? 'selected' : '' }}>
                            <i class="bi bi-person-badge"></i> Odontólogo
                        </option>
                        <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>
                            <i class="bi bi-shield-lock"></i> Administrador
                        </option>
                    </select>
                </div>

                <div class="row-form">
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Al menos 6 caracteres" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Repite tu contraseña" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-person-plus-fill"></i> Registrarse</button>
            </form>

            <div class="auth-link">
                ¿Ya tienes cuenta? <a href="#" onclick="document.querySelector('#identifier').focus(); window.scrollTo(0, 0);">Inicia sesión</a>
            </div>
        </div>
    </div>
</div>
@endsection
