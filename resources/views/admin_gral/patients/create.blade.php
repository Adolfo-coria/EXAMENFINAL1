@extends('layouts.app')

@section('title', isset($patient) ? 'Editar Paciente' : 'Nuevo Paciente')
@section('page-title', isset($patient) ? 'Editar Paciente' : 'Registrar Nuevo Paciente')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        {{ isset($patient) ? 'Editar Información del Paciente' : 'Registrar Nuevo Paciente' }}
                    </h5>
                </div>
                <div class="card-body">
                    @if (isset($patient))
                        <form action="{{ route('patients.update', $patient) }}" method="POST">
                            @method('PUT')
                    @else
                        <form action="{{ route('patients.store') }}" method="POST">
                    @endif
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nombre *</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                id="first_name" name="first_name" 
                                value="{{ old('first_name', $patient->first_name ?? '') }}" required>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Apellido *</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                id="last_name" name="last_name" 
                                value="{{ old('last_name', $patient->last_name ?? '') }}" required>
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" 
                                value="{{ old('email', $patient->email ?? '') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" name="phone" 
                                value="{{ old('phone', $patient->phone ?? '') }}" required>
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ci" class="form-label">Cédula de Identidad *</label>
                            <input type="text" class="form-control @error('ci') is-invalid @enderror" 
                                id="ci" name="ci" 
                                value="{{ old('ci', $patient->ci ?? '') }}" required>
                            @error('ci')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label">Fecha de Nacimiento *</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                id="date_of_birth" name="date_of_birth" 
                                value="{{ old('date_of_birth', isset($patient) ? $patient->date_of_birth->format('Y-m-d') : '') }}" required>
                            @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Género *</label>
                            <select class="form-select @error('gender') is-invalid @enderror" 
                                id="gender" name="gender" required>
                                <option value="">Seleccione...</option>
                                <option value="male" {{ old('gender', $patient->gender ?? '') == 'male' ? 'selected' : '' }}>Masculino</option>
                                <option value="female" {{ old('gender', $patient->gender ?? '') == 'female' ? 'selected' : '' }}>Femenino</option>
                                <option value="other" {{ old('gender', $patient->gender ?? '') == 'other' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">Ciudad</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                id="city" name="city" 
                                value="{{ old('city', $patient->city ?? '') }}">
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                            id="address" name="address" rows="3">{{ old('address', $patient->address ?? '') }}</textarea>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="medical_history" class="form-label">Historial Médico</label>
                        <textarea class="form-control @error('medical_history') is-invalid @enderror" 
                            id="medical_history" name="medical_history" rows="3">{{ old('medical_history', $patient->medical_history ?? '') }}</textarea>
                        @error('medical_history')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    @if (isset($patient))
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado *</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="active" {{ old('status', $patient->status ?? '') == 'active' ? 'selected' : '' }}>Activo</option>
                                <option value="inactive" {{ old('status', $patient->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @endif

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> {{ isset($patient) ? 'Actualizar' : 'Registrar' }}
                        </button>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
