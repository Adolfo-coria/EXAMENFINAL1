<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Definir permisos para cada sección
        $permissions = [
            // Permisos para Odontólogo
            ['name' => 'dentist.view_appointments', 'description' => 'Ver citas'],
            ['name' => 'dentist.create_appointments', 'description' => 'Crear citas'],
            ['name' => 'dentist.edit_appointments', 'description' => 'Editar citas'],
            ['name' => 'dentist.view_patients', 'description' => 'Ver pacientes'],
            ['name' => 'dentist.view_diagnostics', 'description' => 'Ver diagnósticos'],
            ['name' => 'dentist.create_diagnostics', 'description' => 'Crear diagnósticos'],
            ['name' => 'dentist.view_treatments', 'description' => 'Ver tratamientos'],
            ['name' => 'dentist.create_treatments', 'description' => 'Crear tratamientos'],
            ['name' => 'dentist.view_recipes', 'description' => 'Ver recetas'],
            ['name' => 'dentist.create_recipes', 'description' => 'Crear recetas'],
            ['name' => 'dentist.view_checkups', 'description' => 'Ver controles'],
            ['name' => 'dentist.create_checkups', 'description' => 'Crear controles'],
            ['name' => 'dentist.view_payments', 'description' => 'Ver pagos'],
            
            // Permisos para Admin
            ['name' => 'admin.view_users', 'description' => 'Ver usuarios'],
            ['name' => 'admin.manage_users', 'description' => 'Gestionar usuarios'],
            ['name' => 'admin.view_appointments', 'description' => 'Ver todas las citas'],
            ['name' => 'admin.view_payments', 'description' => 'Ver todos los pagos'],
            
            // Permisos para Paciente
            ['name' => 'patient.view_own_appointments', 'description' => 'Ver propias citas'],
            ['name' => 'patient.book_appointment', 'description' => 'Reservar cita'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Asignar permisos a roles
        $dentistPermissions = [
            'dentist.view_appointments',
            'dentist.create_appointments',
            'dentist.edit_appointments',
            'dentist.view_patients',
            'dentist.view_diagnostics',
            'dentist.create_diagnostics',
            'dentist.view_treatments',
            'dentist.create_treatments',
            'dentist.view_recipes',
            'dentist.create_recipes',
            'dentist.view_checkups',
            'dentist.create_checkups',
            'dentist.view_payments',
        ];

        $adminPermissions = [
            'admin.view_users',
            'admin.manage_users',
            'admin.view_appointments',
            'admin.view_payments',
        ];

        $patientPermissions = [
            'patient.view_own_appointments',
            'patient.book_appointment',
        ];

        // Guardar en tabla role_permissions
        foreach ($dentistPermissions as $permName) {
            $perm = Permission::where('name', $permName)->first();
            if ($perm) {
                DB::table('role_permissions')->updateOrInsert(
                    ['role' => 'dentist', 'permission_id' => $perm->id]
                );
            }
        }

        foreach ($adminPermissions as $permName) {
            $perm = Permission::where('name', $permName)->first();
            if ($perm) {
                DB::table('role_permissions')->updateOrInsert(
                    ['role' => 'admin', 'permission_id' => $perm->id]
                );
            }
        }

        foreach ($patientPermissions as $permName) {
            $perm = Permission::where('name', $permName)->first();
            if ($perm) {
                DB::table('role_permissions')->updateOrInsert(
                    ['role' => 'patient', 'permission_id' => $perm->id]
                );
            }
        }
    }
}
