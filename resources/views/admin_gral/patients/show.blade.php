@extends('layouts.app')

@section('title', 'Ver Paciente')
@section('page-title', 'Detalles del Paciente')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ $patient->full_name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Email</h6>
                            <p>{{ $patient->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Teléfono</h6>
                            <p>{{ $patient->phone }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Cédula de Identidad</h6>
                            <p>{{ $patient->ci }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Fecha de Nacimiento</h6>
                            <p>{{ $patient->date_of_birth->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Género</h6>
                            <p>
                                @if ($patient->gender === 'male')
                                    Masculino
                                @elseif ($patient->gender === 'female')
                                    Femenino
                                @else
                                    Otro
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Ciudad</h6>
                            <p>{{ $patient->city ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-muted">Dirección</h6>
                            <p>{{ $patient->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-muted">Historial Médico</h6>
                            <p>{{ $patient->medical_history ?? 'Sin registros' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Estado</h6>
                            <p>
                                <span class="badge @if ($patient->status === 'active') bg-success @else bg-danger @endif">
                                    {{ ucfirst($patient->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Registrado</h6>
                            <p>{{ $patient->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Acciones</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a href="{{ route('appointments.index', ['patient' => $patient->id]) }}" class="btn btn-info">
                        <i class="bi bi-calendar-check"></i> Ver Citas
                    </a>
                    <a href="{{ route('payments.index', ['patient' => $patient->id]) }}" class="btn btn-info">
                        <i class="bi bi-cash-stack"></i> Ver Pagos
                    </a>
                    <form action="{{ route('patients.destroy', $patient) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('¿Está seguro de que desea eliminar este paciente?')">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
