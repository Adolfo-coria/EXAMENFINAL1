<?php

namespace App\Http\Controllers;

class OdontologoController extends Controller
{
    /**
     * Mostrar el dashboard del odontólogo (reutiliza la vista Blade)
     */
    public function index()
    {
        return view('odontologo.dashboard');
    }

    public function historial()
    {
        return view('odontologo.historial');
    }

    public function diagnosticos()
    {
        return view('odontologo.diagnosticos');
    }

    public function tratamientos()
    {
        return view('odontologo.tratamientos');
    }

    public function recetas()
    {
        return view('odontologo.recetas');
    }

    public function controles()
    {
        return view('odontologo.controles');
    }
}
