@extends('layouts.app')

@section('title', 'Gestión de Pacientes')
@section('page-title', 'Gestión de Pacientes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Listado de Pacientes</h2>
        <a href="{{ route('patients.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Nuevo Paciente
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Cédula de Identidad</th>
                        <th>Género</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                        <tr>
                            <td>{{ $patient->full_name }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->ci }}</td>
                            <td>
                                @if ($patient->gender === 'male')
                                    Masculino
                                @elseif ($patient->gender === 'female')
                                    Femenino
                                @else
                                    Otro
                                @endif
                            </td>
                            <td>{{ $patient->city ?? 'N/A' }}</td>
                            <td>
                                <span class="badge @if ($patient->status === 'active') bg-success @else bg-danger @endif">
                                    {{ ucfirst($patient->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('patients.destroy', $patient) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro?')" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="text-muted">No hay pacientes registrados</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $patients->links('pagination::bootstrap-5') }}
    </div>
@endsection
