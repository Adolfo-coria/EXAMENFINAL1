<?php

namespace App\Http\Controllers;

class SuperAdminController extends Controller
{
    /**
     * Mostrar la vista del super administrador.
     */
    public function index(): \Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {
        $path = resource_path('views/super_admin/superadmin.html');
        $content = @file_get_contents($path);
        if ($content !== false) {
            return response($content, 200, ['Content-Type' => 'text/html']);
        }

        return view('welcome');
    }
}
