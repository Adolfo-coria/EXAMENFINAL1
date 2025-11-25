<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::paginate(15);
        return view('admin_gral.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_gral.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:patients',
            'phone' => 'required|string|max:20',
            'ci' => 'required|string|unique:patients',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'medical_history' => 'nullable|string',
        ]);

        Patient::create($validated);
        return redirect()->route('patients.index')->with('success', 'Paciente registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('admin_gral.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('admin_gral.patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'phone' => 'required|string|max:20',
            'ci' => 'required|string|unique:patients,ci,' . $patient->id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'medical_history' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $patient->update($validated);
        return redirect()->route('patients.index')->with('success', 'Paciente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Paciente eliminado exitosamente');
    }
}
