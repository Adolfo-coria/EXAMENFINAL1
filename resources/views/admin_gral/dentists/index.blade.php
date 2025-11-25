@extends('layouts.app')

@section('title', 'Gestión de Odontólogos')
@section('page-title', 'Gestión de Odontólogos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Listado de Odontólogos</h2>
        <a href="{{ route('dentists.create') }}" class="btn btn-primary"><i class="bi bi-person-plus"></i> Nuevo Odontólogo</a>
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
                        <th>Nombre</th>
                        <th>Especialización</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Horario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dentists as $dentist)
                        <tr>
                            <td><strong>{{ $dentist->first_name }} {{ $dentist->last_name }}</strong></td>
                            <td>{{ $dentist->specialization ?? 'N/A' }}</td>
                            <td>{{ $dentist->phone }}</td>
                            <td>{{ $dentist->email }}</td>
                            <td>{{ $dentist->start_time }} - {{ $dentist->end_time }}</td>
                            <td>
                                <span class="badge bg-{{ $dentist->status == 'active' ? 'success' : 'danger' }}">
                                    {{ $dentist->status == 'active' ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('dentists.show', $dentist->id) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('dentists.edit', $dentist->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dentists.destroy', $dentist->id) }}" method="POST" style="display: inline;">
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
                                No hay odontólogos registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
