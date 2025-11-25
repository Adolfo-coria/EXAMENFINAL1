<?php

namespace App\Http\Controllers;

class PacienteController extends Controller
{
    /**
     * Mostrar la vista del paciente.
     */
    public function index(): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $path = resource_path('views/paciente/paciente.html');
        $content = @file_get_contents($path);
        if ($content !== false) {
            return response($content, 200, ['Content-Type' => 'text/html']);
        }

        return view('welcome');
    }
}
