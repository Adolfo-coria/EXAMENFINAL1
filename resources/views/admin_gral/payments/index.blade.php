@extends('layouts.app')

@section('page-title', 'Pagos y Facturación')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Pagos y Facturación</h2>
    <a href="{{ route('payments.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nuevo Pago</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted">Total Pagos</h6>
                <h3>Bs. {{ number_format($totalPayments, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted">Pagos Pendientes</h6>
                <h3>Bs. {{ number_format($pendingAmount, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted">Pagos Completados</h6>
                <h3>Bs. {{ number_format($completedAmount, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted">Total Transacciones</h6>
                <h3>{{ $totalTransactions }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Cita</th>
                    <th>Monto</th>
                    <th>Método de Pago</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td><strong>{{ $payment->patient->name ?? 'N/A' }}</strong></td>
                        <td>
                            @if($payment->appointment)
                                {{ \Carbon\Carbon::parse($payment->appointment->appointment_date)->format('d/m/Y H:i') }}
                            @else
                                <span class="text-muted">Sin cita</span>
                            @endif
                        </td>
                        <td>Bs. {{ number_format($payment->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $payment->status == 'pending' ? 'warning' : 'success' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-info" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display: inline;">
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
                        <td colspan="7" class="text-center text-muted py-4">
                            No hay pagos registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
