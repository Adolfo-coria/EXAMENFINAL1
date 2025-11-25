@extends('layouts.odontologo')

@section('page-title','Panel Odontólogo')

@section('content')

<!-- Perfil del Odontólogo -->
<div class="profile-header">
  <img src="https://cdn-icons-png.flaticon.com/512/3774/3774297.png" alt="Odontólogo">
  <div>
    <h2>{{ Auth::user()->name ?? 'Dr. Odontólogo' }}</h2>
    <p style="margin:4px 0;color:#555;">Especialidad: <strong>Odontología General</strong></p>
    <p style="margin:0;color:#555;">Correo: <strong>{{ Auth::user()->email ?? 'correo@clinica.com' }}</strong></p>
  </div>
</div>

<!-- Tarjetas de Acceso Rápido -->
<div class="row g-4 cards-container">
  <div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('odontologo.historial') }}" class="text-decoration-none">
      <div class="card">
        <i class="bi bi-folder2-open"></i>
        <h5>Historial Médico</h5>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('odontologo.diagnosticos') }}" class="text-decoration-none">
      <div class="card">
        <i class="bi bi-file-earmark-medical"></i>
        <h5>Diagnóstico</h5>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('odontologo.tratamientos') }}" class="text-decoration-none">
      <div class="card">
        <i class="bi bi-heart-pulse"></i>
        <h5>Tratamientos</h5>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('odontologo.recetas') }}" class="text-decoration-none">
      <div class="card">
        <i class="bi bi-prescription2"></i>
        <h5>Recetas</h5>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('odontologo.controles') }}" class="text-decoration-none">
      <div class="card">
        <i class="bi bi-calendar-check"></i>
        <h5>Controles</h5>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('appointments.index') }}" class="text-decoration-none">
      <div class="card">
        <i class="bi bi-calendar-event"></i>
        <h5>Citas</h5>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('patients.index') }}" class="text-decoration-none">
      <div class="card">
        <i class="bi bi-person-vcard"></i>
        <h5>Pacientes</h5>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('payments.index') }}" class="text-decoration-none">
      <div class="card">
        <i class="bi bi-cash-stack"></i>
        <h5>Pagos</h5>
      </div>
    </a>
  </div>
</div>

<!-- Sección de Permisos (Debug Mode) -->
@if(config('app.debug'))
<div class="mt-5">
  <div class="card" style="border-left: 4px solid #20B2AA; background-color: #f9f9f9;">
    <div class="card-body">
      <h5 class="card-title">
        <i class="bi bi-shield-check" style="color: #20B2AA;"></i> Permisos del Usuario
      </h5>
      <div class="mt-3">
        @php
          $permisos = \App\Support\PermissionHelper::getUserPermissions();
        @endphp
        
        @if(count($permisos) > 0)
          <div class="row">
            @foreach($permisos as $permiso)
              <div class="col-md-6 col-lg-4 mb-2">
                <span class="badge bg-success">
                  <i class="bi bi-check-circle"></i> {{ $permiso }}
                </span>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-muted">No hay permisos asignados</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@section('styles')
<style>
  .cards-container a {
    transition: all 0.3s ease;
  }

  .cards-container a:hover {
    transform: scale(1.02);
  }

  .badge {
    margin-right: 5px;
    margin-bottom: 5px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: 500;
  }

  .card-body {
    padding: 20px;
  }

  .card-title {
    font-weight: 600;
    color: #20B2AA;
  }
</style>
@endsection