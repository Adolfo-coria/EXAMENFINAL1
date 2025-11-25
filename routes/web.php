<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Home
Route::get('/', function () {
    return view('home');
});

// Routes protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Admin routes: solo accesible por usuarios con role = admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware(\App\Http\Middleware\EnsureUserRole::class . ':admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        });
    });

    // Odontólogo routes: solo accesible por usuarios con role = dentist
    Route::prefix('odontologo')->name('odontologo.')->group(function () {
        Route::middleware(\App\Http\Middleware\EnsureUserRole::class . ':dentist')->group(function () {
            Route::get('/dashboard', function () {
                return view('odontologo.dashboard');
            })->name('dashboard');

            // Páginas del odontólogo con protección de permisos
            Route::get('/historial', [\App\Http\Controllers\OdontologoController::class, 'historial'])
                ->middleware('EnsurePermission:dentist.view_appointments')
                ->name('historial');
            
            Route::get('/diagnosticos', [\App\Http\Controllers\OdontologoController::class, 'diagnosticos'])
                ->middleware('EnsurePermission:dentist.view_diagnostics')
                ->name('diagnosticos');
            
            Route::get('/tratamientos', [\App\Http\Controllers\OdontologoController::class, 'tratamientos'])
                ->middleware('EnsurePermission:dentist.view_treatments')
                ->name('tratamientos');
            
            Route::get('/recetas', [\App\Http\Controllers\OdontologoController::class, 'recetas'])
                ->middleware('EnsurePermission:dentist.view_recipes')
                ->name('recetas');
            
            Route::get('/controles', [\App\Http\Controllers\OdontologoController::class, 'controles'])
                ->middleware('EnsurePermission:dentist.view_checkups')
                ->name('controles');
        });
    });

    // Resource routes para CRUD (solo accesibles cuando el usuario está autenticado)
    Route::resource('patients', PatientController::class);
    Route::resource('dentists', DentistController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('payments', PaymentController::class);
});

// Auth routes (placeholder)
// Auth (login / register / logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

