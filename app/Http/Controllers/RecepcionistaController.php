<?php

namespace App\Http\Controllers;

class RecepcionistaController extends Controller
{
    /**
     * Mostrar la vista de recepcionista.
     */
    public function index(): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $path = resource_path('views/recepcionista/recepcionista.html');
        $content = @file_get_contents($path);
        if ($content !== false) {
            return response($content, 200, ['Content-Type' => 'text/html']);
        }

        return view('welcome');
    }
}
