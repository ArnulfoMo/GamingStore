<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Http\Requests\UpdateUserStatusRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::with('roles')->orderBy('name')->paginate(15);
        $roles = Role::whereIn('nombre', ['administrador', 'operador', 'cliente'])->orderBy('nombre')->get();

        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRoleRequest $request, User $usuario)
    {
        $datos = $request->validated();

        $role = Role::findOrFail($datos['role_id']);

        if ($usuario->is($request->user()) && $role->nombre !== 'administrador') {
            throw ValidationException::withMessages([
                'role_id' => 'No puedes quitarte tu propio rol de administrador.',
            ]);
        }

        $usuario->roles()->sync([$role->id]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Rol actualizado correctamente.',
                'role_id' => $role->id,
                'role' => ucfirst($role->nombre),
            ]);
        }

        return back()->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //
    }

    public function updateStatus(UpdateUserStatusRequest $request, User $usuario)
    {
        $activo = $request->boolean('activo');

        if ($usuario->is($request->user()) && ! $activo) {
            throw ValidationException::withMessages([
                'activo' => 'No puedes desactivar tu propia cuenta de administrador.',
            ]);
        }

        $usuario->activo = $activo;

        if (! $activo) {
            $usuario->setRememberToken(Str::random(60));
        }

        $usuario->save();

        $mensaje = $activo ? 'Cuenta activada correctamente.' : 'Cuenta desactivada correctamente.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $mensaje,
                'activo' => $usuario->activo,
            ]);
        }

        return back()->with('success', $mensaje);
    }
}
