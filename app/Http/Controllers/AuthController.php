<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegistrationAvailabilityRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credenciales = $request->safe()->only(['email', 'password']);
        $credenciales['activo'] = 1;

        if (Auth::attempt($credenciales, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route(Auth::user()->homeRoute()))
                ->with('success', 'Bienvenido, '.Auth::user()->name);
        }

        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos, o la cuenta está desactivada.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function checkRegistrationAvailability(RegistrationAvailabilityRequest $request)
    {
        $datos = $request->validated();

        return response()->json([
            'available' => ! User::where($datos['field'], $datos['value'])->exists(),
        ])->header('Cache-Control', 'no-store');
    }

    public function register(RegisterRequest $request)
    {
        $datos = $request->validated();

        $user = DB::transaction(function () use ($datos) {
            $user = User::create([
                'name' => $datos['name'],
                'gamertag' => $datos['gamertag'],
                'email' => $datos['email'],
                'password' => Hash::make($datos['password']),
            ]);

            $role = Role::firstOrCreate(['nombre' => 'cliente']);
            $user->roles()->attach($role);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('inicio')->with('success', 'Bienvenido, '.$user->name);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
}
