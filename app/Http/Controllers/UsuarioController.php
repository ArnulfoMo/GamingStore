<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('roles')->orderBy('name')->paginate(15);
        $roles = Role::whereIn('nombre', ['administrador', 'operador', 'cliente'])->orderBy('nombre')->get();

        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    public function updateRole(Request $request, User $usuario)
    {
        $datos = $request->validate([
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')->whereIn('nombre', ['administrador', 'operador', 'cliente'])],
        ], [
            'role_id.required' => 'Selecciona un rol.',
            'role_id.integer' => 'El rol seleccionado no es válido.',
            'role_id.exists' => 'El rol seleccionado no es válido.',
        ]);

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
}
