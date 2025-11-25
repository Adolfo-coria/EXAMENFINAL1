@extends('layouts.app')

@section('page-title', 'Citas y Reservas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Citas y Reservas</h2>
    <a href="{{ route('appointments.create') }}" class="btn btn-primary"><i class="bi bi-calendar-plus"></i> Nueva Cita</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Odontólogo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Motivo</th>
                    <th>Costo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td><strong>{{ $appointment->patient->name ?? 'N/A' }}</strong></td>
                        <td>{{ $appointment->dentist->first_name ?? 'N/A' }} {{ $appointment->dentist->last_name ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                        <td>{{ $appointment->start_time }}</td>
                        <td>{{ $appointment->reason }}</td>
                        <td>Bs. {{ number_format($appointment->cost, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : ($appointment->status == 'completed' ? 'success' : 'danger') }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-sm btn-info" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No hay citas registradas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
