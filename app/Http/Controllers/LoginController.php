<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    /**
     * Mostrar la vista de login para pacientes.
     */
    public function index(): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $path = resource_path('views/login/pacientes.html');
        $content = @file_get_contents($path);
        if ($content !== false) {
            return response($content, 200, ['Content-Type' => 'text/html']);
        }

        return view('welcome');
    }
}
