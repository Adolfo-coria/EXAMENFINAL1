@extends('layouts.app')

@section('page-title', 'Nueva Cita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Agendar Nueva Cita</h2>
    <a href="{{ route('appointments.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('appointments.store') }}" method="POST" novalidate>
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
                            <label for="dentist_id" class="form-label">Odontólogo *</label>
                            <select class="form-select @error('dentist_id') is-invalid @enderror" id="dentist_id" name="dentist_id" required>
                                <option value="">Seleccionar odontólogo...</option>
                                @foreach($dentists as $dentist)
                                    <option value="{{ $dentist->id }}" {{ old('dentist_id') == $dentist->id ? 'selected' : '' }}>
                                        {{ $dentist->first_name }} {{ $dentist->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dentist_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="appointment_date" class="form-label">Fecha de Cita *</label>
                            <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" 
                                   id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" required>
                            @error('appointment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="start_time" class="form-label">Hora Inicio *</label>
                            <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                                   id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="end_time" class="form-label">Hora Fin *</label>
                            <input type="time" class="form-control @error('end_time') is-invalid @enderror" 
                                   id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label">Motivo de la Consulta *</label>
                        <textarea class="form-control @error('reason') is-invalid @enderror" 
                                  id="reason" name="reason" rows="2" required placeholder="Describe el motivo de la cita">{{ old('reason') }}</textarea>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notas Adicionales</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" name="notes" rows="3" placeholder="Notas adicionales sobre la cita...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cost" class="form-label">Costo de la Consulta (Bs.) *</label>
                            <input type="number" step="0.01" class="form-control @error('cost') is-invalid @enderror" 
                                   id="cost" name="cost" value="{{ old('cost') }}" required>
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Estado *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmada</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completada</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-3">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Guardar Cita</button>
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
