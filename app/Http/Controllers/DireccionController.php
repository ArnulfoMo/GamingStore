<?php

namespace App\Http\Controllers;

use App\Http\Requests\DireccionRequest;
use App\Models\Direccion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $direcciones = $request->user()->direcciones()
            ->orderByPivot('principal', 'desc')
            ->orderBy('direcciones.id')
            ->paginate(6);

        return view('cliente.direcciones.index', compact('direcciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $direccion = new Direccion;

        return view('cliente.direcciones.create', compact('direccion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DireccionRequest $request)
    {
        $datos = $request->validated();
        unset($datos['principal']);

        DB::transaction(function () use ($request, $datos) {
            $usuario = User::lockForUpdate()->findOrFail($request->user()->id);
            $esPrincipal = $request->boolean('principal') || ! $usuario->direcciones()->exists();
            $direccion = Direccion::create($datos);
            $usuario->direcciones()->attach($direccion->id, ['principal' => 0]);

            if ($esPrincipal) {
                $this->establecerPrincipal($usuario, $direccion);
            }
        });

        return redirect()->route('direcciones.index')->with('success', 'Dirección agregada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Direccion $direccion)
    {
        $direccion = $request->user()->direcciones()->findOrFail($direccion->id);

        return view('cliente.direcciones.show', compact('direccion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Direccion $direccion)
    {
        $direccion = $request->user()->direcciones()->findOrFail($direccion->id);

        return view('cliente.direcciones.edit', compact('direccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DireccionRequest $request, Direccion $direccion)
    {
        $datos = $request->validated();
        unset($datos['principal']);

        DB::transaction(function () use ($request, $direccion, $datos) {
            $usuario = User::lockForUpdate()->findOrFail($request->user()->id);
            $direccion = $usuario->direcciones()->findOrFail($direccion->id);
            $esPrincipal = $request->boolean('principal') || (bool) $direccion->pivot->principal;

            
            if ($this->tieneReferencias($direccion) || $direccion->usuarios()->where('users.id', '!=', $usuario->id)->exists()) {
                $original = $direccion;
                $direccion = Direccion::create($datos);
                $usuario->direcciones()->attach($direccion->id, ['principal' => 0]);
                $usuario->direcciones()->detach($original->id);
            } else {
                $direccion->update($datos);
            }

            if ($esPrincipal) {
                $this->establecerPrincipal($usuario, $direccion);
            }
        });

        return redirect()->route('direcciones.index')->with('success', 'Dirección actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Direccion $direccion)
    {
        DB::transaction(function () use ($request, $direccion) {
            $usuario = User::lockForUpdate()->findOrFail($request->user()->id);
            $direccion = $usuario->direcciones()->findOrFail($direccion->id);
            $eraPrincipal = (bool) $direccion->pivot->principal;
            $usuario->direcciones()->detach($direccion->id);

            if (! $direccion->usuarios()->exists() && ! $this->tieneReferencias($direccion)) {
                $direccion->delete();
            }

            if ($eraPrincipal) {
                $siguiente = $usuario->direcciones()->orderBy('direcciones.id')->first();
                if ($siguiente) {
                    $this->establecerPrincipal($usuario, $siguiente);
                }
            }
        });

        return redirect()->route('direcciones.index')->with('success', 'Dirección eliminada de tu libreta.');
    }

    public function principal(Request $request, Direccion $direccion)
    {
        DB::transaction(function () use ($request, $direccion) {
            $usuario = User::lockForUpdate()->findOrFail($request->user()->id);
            $direccion = $usuario->direcciones()->findOrFail($direccion->id);
            $this->establecerPrincipal($usuario, $direccion);
        });

        return redirect()->route('direcciones.index')->with('success', 'Dirección principal actualizada.');
    }

    private function establecerPrincipal(User $usuario, Direccion $direccion): void
    {
        DB::table('usuario_direcciones')->where('usuario_id', $usuario->id)->update(['principal' => 0]);
        $usuario->direcciones()->updateExistingPivot($direccion->id, ['principal' => 1]);
    }

    private function tieneReferencias(Direccion $direccion): bool
    {
        return DB::table('ventas')->where('direccion_id', $direccion->id)->exists()
            || DB::table('sucursales')->where('direccion_id', $direccion->id)->exists();
    }
}
