<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Dentist;
use App\Models\Appointment;
use App\Models\Payment;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Mostrar el dashboard principal con estadísticas.
     */
    public function index()
    {
        // Estadísticas generales
        $totalPatients = Patient::where('status', 'active')->count();
        $totalDentists = Dentist::where('status', 'active')->count();
        $todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())->count();
        $monthlyRevenue = Payment::where('status', 'completed')
            ->whereMonth('payment_date', Carbon::now()->month)
            ->whereYear('payment_date', Carbon::now()->year)
            ->sum('amount');

        // Datos para gráficos
        $weeklyAppointments = $this->getWeeklyAppointments();
        $monthlyData = $this->getMonthlyData();

        return view('admin_gral.dashboard', compact(
            'totalPatients',
            'totalDentists',
            'todayAppointments',
            'monthlyRevenue',
            'weeklyAppointments',
            'monthlyData'
        ));
    }

    /**
     * Obtener citas semanales para el gráfico
     */
    private function getWeeklyAppointments()
    {
        $data = [];
        $labels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('D');
            $count = Appointment::whereDate('appointment_date', $date)->count();
            $data[] = $count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Obtener datos mensuales (citas y nuevos pacientes)
     */
    private function getMonthlyData()
    {
        $currentMonth = Carbon::now();
        $appointments = Appointment::whereMonth('appointment_date', $currentMonth->month)
            ->whereYear('appointment_date', $currentMonth->year)
            ->count();
        
        $newPatients = Patient::whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->count();

        return [
            'appointments' => $appointments,
            'newPatients' => $newPatients,
        ];
    }
}
