@extends('layouts.app')

@section('page-title', 'Registrar Nuevo Pago')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Registrar Nuevo Pago</h2>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('payments.store') }}" method="POST" novalidate>
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="patient_id" class="form-label">Paciente *</label>
                            <select class="form-select @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id" required>
                                <option value="">Seleccionar paciente...</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->first_name }} {{ $patient->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="appointment_id" class="form-label">Cita Asociada</label>
                            <select class="form-select @error('appointment_id') is-invalid @enderror" id="appointment_id" name="appointment_id">
                                <option value="">Seleccionar cita (opcional)...</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                        {{ $appointment->patient->name }} - {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('appointment_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Monto (Bs.) *</label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" name="amount" value="{{ old('amount') }}" required placeholder="0.00">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="payment_method" class="form-label">Método de Pago *</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                <option value="">Seleccionar método...</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Efectivo</option>
                                <option value="check" {{ old('payment_method') == 'check' ? 'selected' : '' }}>Cheque</option>
                                <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transferencia</option>
                                <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Tarjeta</option>
                                <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="payment_date" class="form-label">Fecha de Pago *</label>
                            <input type="date" class="form-control @error('payment_date') is-invalid @enderror" 
                                   id="payment_date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required>
                            @error('payment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Estado *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completado</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="transaction_id" class="form-label">ID de Transacción</label>
                        <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" 
                               id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}" placeholder="Ej: TRX123456">
                        @error('transaction_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" placeholder="Detalles adicionales del pago...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 pt-3">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Guardar Pago</button>
                        <a href="{{ route('payments.index') }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
