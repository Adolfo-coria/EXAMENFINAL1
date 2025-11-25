@extends('layouts.app')

@section('page-title', 'Detalles de Cita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Detalles de la Cita</h2>
    <div>
        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</a>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-person-circle"></i> Información del Paciente</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> {{ $appointment->patient->name ?? 'N/A' }}</p>
                        <p><strong>Teléfono:</strong> {{ $appointment->patient->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $appointment->patient->email ?? 'N/A' }}</p>
                        <p><strong>CI:</strong> {{ $appointment->patient->ci ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-stethoscope"></i> Información del Odontólogo</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> {{ $appointment->dentist->first_name ?? '' }} {{ $appointment->dentist->last_name ?? '' }}</p>
                        <p><strong>Especialización:</strong> {{ $appointment->dentist->specialization ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Teléfono:</strong> {{ $appointment->dentist->phone ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $appointment->dentist->email ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Detalles de la Cita</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
                        <p><strong>Hora Inicio:</strong> {{ $appointment->start_time }}</p>
                        <p><strong>Hora Fin:</strong> {{ $appointment->end_time }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Costo:</strong> Bs. {{ number_format($appointment->cost, 2) }}</p>
                        <p><strong>Estado:</strong> 
                            <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : ($appointment->status == 'completed' ? 'success' : ($appointment->status == 'confirmed' ? 'info' : 'danger')) }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-chat-dots"></i> Motivo y Notas</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <p><strong>Motivo de la Consulta:</strong></p>
                    <p class="text-muted">{{ $appointment->reason }}</p>
                </div>
                @if($appointment->notes)
                    <div>
                        <p><strong>Notas Adicionales:</strong></p>
                        <p class="text-muted">{{ $appointment->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>
            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                    <i class="bi bi-trash"></i> Eliminar
                </button>
            </form>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>
</div>
@endsection
