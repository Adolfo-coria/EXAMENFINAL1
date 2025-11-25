@extends('layouts.app')

@section('page-title', 'Detalles del Pago')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Detalles del Pago / Comprobante</h2>
    <div>
        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</a>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-receipt"></i> Información de Pago</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID de Pago:</strong> #{{ $payment->id }}</p>
                        <p><strong>Fecha de Pago:</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</p>
                        <p><strong>Monto:</strong> <span class="text-success fw-bold">Bs. {{ number_format($payment->amount, 2) }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Método de Pago:</strong> {{ ucfirst($payment->payment_method) }}</p>
                        <p><strong>ID de Transacción:</strong> {{ $payment->transaction_id ?? 'N/A' }}</p>
                        <p><strong>Estado:</strong> 
                            <span class="badge bg-{{ $payment->status == 'pending' ? 'warning' : ($payment->status == 'completed' ? 'success' : 'danger') }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-person-circle"></i> Información del Paciente</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> {{ $payment->patient->name ?? 'N/A' }}</p>
                        <p><strong>Teléfono:</strong> {{ $payment->patient->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $payment->patient->email ?? 'N/A' }}</p>
                        <p><strong>CI:</strong> {{ $payment->patient->ci ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($payment->appointment)
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Información de la Cita</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Fecha de Cita:</strong> {{ \Carbon\Carbon::parse($payment->appointment->appointment_date)->format('d/m/Y H:i') }}</p>
                        <p><strong>Odontólogo:</strong> {{ $payment->appointment->dentist->first_name ?? '' }} {{ $payment->appointment->dentist->last_name ?? '' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Motivo:</strong> {{ $payment->appointment->reason ?? 'N/A' }}</p>
                        <p><strong>Costo de Cita:</strong> Bs. {{ number_format($payment->appointment->cost, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($payment->description)
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-chat-dots"></i> Descripción</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">{{ $payment->description }}</p>
            </div>
        </div>
        @endif

        <div class="card mb-3 border-2 border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-printer"></i> Acciones</h5>
            </div>
            <div class="card-body">
                <p class="mb-3"><strong>Opciones de comprobante:</strong></p>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" onclick="window.print()"><i class="bi bi-printer"></i> Imprimir Comprobante</button>
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary"><i class="bi bi-download"></i> Descargar PDF</a>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>
            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este pago?')">
                    <i class="bi bi-trash"></i> Eliminar
                </button>
            </form>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>
</div>
@endsection
