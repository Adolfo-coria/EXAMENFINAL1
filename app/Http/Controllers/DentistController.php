<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use Illuminate\Http\Request;

class DentistController extends Controller
{
    public function index()
    {
        $dentists = Dentist::paginate(15);
        return view('admin_gral.dentists.index', compact('dentists'));
    }

    public function create()
    {
        return view('admin_gral.dentists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:dentists',
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|unique:dentists',
            'specialization' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'office_location' => 'nullable|string',
            'biography' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Dentist::create($validated);
        return redirect()->route('dentists.index')->with('success', 'Odontólogo registrado exitosamente');
    }

    public function show(Dentist $dentist)
    {
        return view('admin_gral.dentists.show', compact('dentist'));
    }

    public function edit(Dentist $dentist)
    {
        return view('admin_gral.dentists.edit', compact('dentist'));
    }

    public function update(Request $request, Dentist $dentist)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:dentists,email,' . $dentist->id,
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|unique:dentists,license_number,' . $dentist->id,
            'specialization' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'office_location' => 'nullable|string',
            'biography' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $dentist->update($validated);
        return redirect()->route('dentists.index')->with('success', 'Odontólogo actualizado exitosamente');
    }

    public function destroy(Dentist $dentist)
    {
        $dentist->delete();
        return redirect()->route('dentists.index')->with('success', 'Odontólogo eliminado exitosamente');
    }
}
