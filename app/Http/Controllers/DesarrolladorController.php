<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesarrolladorRequest;
use App\Models\Desarrollador;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DesarrolladorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $desarrolladores = Desarrollador::orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.desarrolladores.partials.tabla', compact('desarrolladores'));
        }

        return view('admin.desarrolladores.index', compact('desarrolladores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desarrollador = new Desarrollador;

        return view('admin.desarrolladores.create', compact('desarrollador'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesarrolladorRequest $request)
    {
        Desarrollador::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Desarrollador registrado correctamente.'], 201);
        }

        return redirect()->route('admin.desarrolladores.index')->with('success', 'Desarrollador registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Desarrollador $desarrollador)
    {
        return view('admin.desarrolladores.show', compact('desarrollador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desarrollador $desarrollador)
    {
        return view('admin.desarrolladores.edit', compact('desarrollador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesarrolladorRequest $request, Desarrollador $desarrollador)
    {
        $desarrollador->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Desarrollador actualizado correctamente.']);
        }

        return redirect()->route('admin.desarrolladores.index')->with('success', 'Desarrollador actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Desarrollador $desarrollador)
    {
        if ($desarrollador->videojuegos()->exists()) {
            throw ValidationException::withMessages([
                'desarrollador' => 'No se puede eliminar este registro porque está en uso.',
            ]);
        }

        $desarrollador->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Desarrollador eliminado correctamente.']);
        }

        return redirect()->route('admin.desarrolladores.index')->with('success', 'Desarrollador eliminado correctamente.');
    }
}
