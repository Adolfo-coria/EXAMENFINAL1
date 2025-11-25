@extends('layouts.app')

@section('page-title', 'Detalle del Odontólogo')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="mb-0 text-white">{{ $dentist->first_name }} {{ $dentist->last_name }}</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Información Personal</h6>
                        <p><strong>Email:</strong> {{ $dentist->email }}</p>
                        <p><strong>Teléfono:</strong> {{ $dentist->phone }}</p>
                        <p><strong>Especialización:</strong> {{ $dentist->specialization ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Información Profesional</h6>
                        <p><strong>Licencia:</strong> {{ $dentist->license_number }}</p>
                        <p><strong>Consultorio:</strong> {{ $dentist->office_location ?? 'N/A' }}</p>
                        <p><strong>Estado:</strong> <span class="badge bg-{{ $dentist->status == 'active' ? 'success' : 'danger' }}">{{ $dentist->status == 'active' ? 'Activo' : 'Inactivo' }}</span></p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-muted">Horario de Atención</h6>
                        <p><strong>De:</strong> {{ $dentist->start_time }} <strong>hasta</strong> {{ $dentist->end_time }}</p>
                    </div>
                </div>

                @if($dentist->biography)
                    <div class="mb-4">
                        <h6 class="text-muted">Biografía</h6>
                        <p>{{ $dentist->biography }}</p>
                    </div>
                @endif

                <div class="d-flex gap-2">
                    <a href="{{ route('dentists.edit', $dentist->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a href="{{ route('dentists.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
