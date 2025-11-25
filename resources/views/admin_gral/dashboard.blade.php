@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Panel de Control - Administrador General')

@section('content')
    <!-- Estadísticas rápidas -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <i class="bi bi-person-vcard"></i>
                <h3>Pacientes Registrados</h3>
                <p>{{ $totalPatients }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <i class="bi bi-person-badge"></i>
                <h3>Odontólogos Activos</h3>
                <p>{{ $totalDentists }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <i class="bi bi-calendar-check"></i>
                <h3>Citas del Día</h3>
                <p>{{ $todayAppointments }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <i class="bi bi-cash-coin"></i>
                <h3>Ingresos del Mes</h3>
                <p>Bs. {{ number_format($monthlyRevenue, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Citas Semanales</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartSemanal"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Citas Mensuales y Nuevos Pacientes</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartMensual"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="row mt-4">
        <div class="col-12">
            <h5 class="mb-3">Accesos Rápidos</h5>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="bi bi-calendar-plus"></i> Registrar Nueva Cita
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('patients.create') }}" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="bi bi-person-add"></i> Agregar Paciente
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('payments.create') }}" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="bi bi-wallet2"></i> Registrar Pago
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="#" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="bi bi-clipboard-data"></i> Ver Reportes
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Gráfico de barras (Citas Semanales)
        const semanalCtx = document.getElementById('chartSemanal');
        new Chart(semanalCtx, {
            type: 'bar',
            data: {
                labels: @json($weeklyAppointments['labels']),
                datasets: [{
                    label: 'Citas realizadas',
                    data: @json($weeklyAppointments['data']),
                    backgroundColor: '#20B2AA'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfico circular (Citas Mensuales y Pacientes Nuevos)
        const mensualCtx = document.getElementById('chartMensual');
        new Chart(mensualCtx, {
            type: 'doughnut',
            data: {
                labels: ['Citas Mensuales', 'Pacientes Nuevos'],
                datasets: [{
                    data: [{{ $monthlyData['appointments'] }}, {{ $monthlyData['newPatients'] }}],
                    backgroundColor: ['#20B2AA', '#008B8B']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection
