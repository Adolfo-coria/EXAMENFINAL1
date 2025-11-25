<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // ahora devolvemos la vista combinada (login + registro)
        return view('auth.general');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = $request->input('identifier');
        $password = $request->input('password');

        $user = User::where('name', $identifier)
            ->orWhere('ci', $identifier)
            ->orWhere('phone', $identifier)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $request->filled('remember'));
            // Redirección según rol
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            if ($user->role === 'dentist') {
                return redirect()->intended(route('odontologo.dashboard'));
            }

            return redirect()->intended('/');
        }

        return back()->withErrors(['identifier' => 'Credenciales inválidas'])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ci' => 'required|string|max:50|unique:users,ci',
            'phone' => 'required|string|max:50|unique:users,phone',
            'email' => 'nullable|email|max:255|unique:users,email',
            'role' => 'required|in:patient,admin,dentist',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'ci' => $request->input('ci'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
