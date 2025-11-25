<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['patient', 'appointment'])->orderBy('payment_date', 'desc')->paginate(15);
        
        // Calcular estadísticas
        $totalPayments = Payment::sum('amount');
        $pendingAmount = Payment::where('status', 'pending')->sum('amount');
        $completedAmount = Payment::where('status', 'completed')->sum('amount');
        $totalTransactions = Payment::count();
        
        return view('admin_gral.payments.index', compact(
            'payments', 'totalPayments', 'pendingAmount', 'completedAmount', 'totalTransactions'
        ));
    }

    public function create()
    {
        $patients = Patient::all();
        $appointments = Appointment::all();
        return view('admin_gral.payments.create', compact('patients', 'appointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,card,transfer,check,other',
            'payment_date' => 'required|date',
            'transaction_id' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        Payment::create($validated);
        return redirect()->route('payments.index')->with('success', 'Pago registrado exitosamente');
    }

    public function show(Payment $payment)
    {
        return view('admin_gral.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $patients = Patient::all();
        $appointments = Appointment::all();
        return view('admin_gral.payments.edit', compact('payment', 'patients', 'appointments'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,card,transfer,check,other',
            'payment_date' => 'required|date',
            'transaction_id' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $payment->update($validated);
        return redirect()->route('payments.index')->with('success', 'Pago actualizado exitosamente');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pago eliminado exitosamente');
    }
}
