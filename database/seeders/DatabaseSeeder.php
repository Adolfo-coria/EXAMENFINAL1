<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\Dentist;
use App\Models\Appointment;
use App\Models\Payment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario admin de prueba
        \App\Models\User::create([
            'name' => 'Admin Prueba',
            'ci' => '00000000',
            'phone' => '70000000',
            'email' => 'admin@local.test',
            'role' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin1234')
        ]);

        // Crear un paciente de prueba en users
        $patientUser = \App\Models\User::create([
            'name' => 'Juan Perez',
            'ci' => '12345678',
            'phone' => '71234567',
            'email' => 'juan@local.test',
            'role' => 'patient',
            'password' => \Illuminate\Support\Facades\Hash::make('patient1234')
        ]);

        // Crear un odontólogo de prueba en users
        $dentistUser = \App\Models\User::create([
            'name' => 'Dr. Carlos Lopez',
            'ci' => '87654321',
            'phone' => '79876543',
            'email' => 'carlos@local.test',
            'role' => 'dentist',
            'password' => \Illuminate\Support\Facades\Hash::make('dentist1234')
        ]);

        // Crear paciente en tabla pacientes
        $patient = Patient::create([
            'first_name' => 'Juan',
            'last_name' => 'Perez',
            'email' => 'juan@local.test',
            'phone' => '71234567',
            'ci' => '12345678',
            'date_of_birth' => '1990-05-15',
            'gender' => 'male',
            'address' => 'Calle Principal 123',
            'city' => 'La Paz',
            'medical_history' => 'Sin alergias conocidas',
            'status' => 'active'
        ]);

        // Crear más pacientes de prueba
        $patient2 = Patient::create([
            'first_name' => 'María',
            'last_name' => 'García',
            'email' => 'maria@local.test',
            'phone' => '72345678',
            'ci' => '23456789',
            'date_of_birth' => '1985-08-20',
            'gender' => 'female',
            'address' => 'Avenida Secundaria 456',
            'city' => 'La Paz',
            'medical_history' => 'Diabetes tipo 2',
            'status' => 'active'
        ]);

        // Crear odontólogo en tabla dentistas
        $dentist = Dentist::create([
            'first_name' => 'Carlos',
            'last_name' => 'Lopez',
            'email' => 'carlos@local.test',
            'phone' => '79876543',
            'license_number' => 'LIC-001-2024',
            'specialization' => 'Odontología General',
            'biography' => 'Profesional con 10 años de experiencia',
            'office_location' => 'Consultorio A - Piso 2',
            'start_time' => '08:00',
            'end_time' => '18:00',
            'status' => 'active'
        ]);

        // Crear más odontólogos de prueba
        $dentist2 = Dentist::create([
            'first_name' => 'Sandra',
            'last_name' => 'Fernandez',
            'email' => 'sandra@local.test',
            'phone' => '73456789',
            'license_number' => 'LIC-002-2024',
            'specialization' => 'Ortodoncia',
            'biography' => 'Especialista en ortodoncia estética',
            'office_location' => 'Consultorio B - Piso 2',
            'start_time' => '09:00',
            'end_time' => '17:00',
            'status' => 'active'
        ]);

        // Crear citas de prueba
        $appointment1 = Appointment::create([
            'patient_id' => $patient->id,
            'dentist_id' => $dentist->id,
            'appointment_date' => now()->addDays(5),
            'start_time' => '10:00',
            'end_time' => '10:30',
            'reason' => 'Limpieza dental',
            'notes' => 'Primera consulta del paciente',
            'cost' => 150.00,
            'status' => 'pending'
        ]);

        $appointment2 = Appointment::create([
            'patient_id' => $patient2->id,
            'dentist_id' => $dentist2->id,
            'appointment_date' => now()->addDays(7),
            'start_time' => '14:00',
            'end_time' => '15:00',
            'reason' => 'Colocación de brackets',
            'notes' => 'Inicio de tratamiento ortodóntico',
            'cost' => 500.00,
            'status' => 'confirmed'
        ]);

        $appointment3 = Appointment::create([
            'patient_id' => $patient->id,
            'dentist_id' => $dentist2->id,
            'appointment_date' => now()->subDays(2),
            'start_time' => '11:00',
            'end_time' => '11:30',
            'reason' => 'Consulta de control',
            'notes' => 'Paciente ha completado tratamiento',
            'cost' => 100.00,
            'status' => 'completed'
        ]);

        // Crear pagos de prueba
        Payment::create([
            'patient_id' => $patient->id,
            'appointment_id' => $appointment1->id,
            'amount' => 150.00,
            'payment_method' => 'cash',
            'payment_date' => now()->addDays(1),
            'transaction_id' => 'TRX-001-2024',
            'description' => 'Pago por limpieza dental',
            'status' => 'completed'
        ]);

        Payment::create([
            'patient_id' => $patient2->id,
            'appointment_id' => $appointment2->id,
            'amount' => 250.00,
            'payment_method' => 'transfer',
            'payment_date' => now(),
            'transaction_id' => 'TRX-002-2024',
            'description' => 'Pago inicial - ortodoncia',
            'status' => 'pending'
        ]);

        Payment::create([
            'patient_id' => $patient->id,
            'appointment_id' => $appointment3->id,
            'amount' => 100.00,
            'payment_method' => 'card',
            'payment_date' => now()->subDays(2),
            'transaction_id' => 'TRX-003-2024',
            'description' => 'Pago por consulta de control',
            'status' => 'completed'
        ]);
    }
}
