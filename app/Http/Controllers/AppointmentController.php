<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Dentist;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'dentist'])->orderBy('appointment_date', 'desc')->paginate(15);
        return view('admin_gral.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::where('status', 'active')->get();
        $dentists = Dentist::where('status', 'active')->get();
        return view('admin_gral.appointments.create', compact('patients', 'dentists'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'dentist_id' => 'required|exists:dentists,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'reason' => 'required|string',
            'notes' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        Appointment::create($validated);
        return redirect()->route('appointments.index')->with('success', 'Cita registrada exitosamente');
    }

    public function show(Appointment $appointment)
    {
        return view('admin_gral.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        return view('admin_gral.appointments.edit', compact('appointment', 'patients', 'dentists'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'dentist_id' => 'required|exists:dentists,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'reason' => 'required|string',
            'notes' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($validated);
        return redirect()->route('appointments.index')->with('success', 'Cita actualizada exitosamente');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Cita eliminada exitosamente');
    }
}
