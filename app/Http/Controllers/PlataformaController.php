<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlataformaRequest;
use App\Models\Plataforma;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PlataformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $plataformas = Plataforma::orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.plataformas.partials.tabla', compact('plataformas'));
        }

        return view('admin.plataformas.index', compact('plataformas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plataforma = new Plataforma;

        return view('admin.plataformas.create', compact('plataforma'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlataformaRequest $request)
    {
        Plataforma::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Plataforma registrada correctamente.'], 201);
        }

        return redirect()->route('admin.plataformas.index')->with('success', 'Plataforma registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plataforma $plataforma)
    {
        return view('admin.plataformas.show', compact('plataforma'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plataforma $plataforma)
    {
        return view('admin.plataformas.edit', compact('plataforma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlataformaRequest $request, Plataforma $plataforma)
    {
        $plataforma->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Plataforma actualizada correctamente.']);
        }

        return redirect()->route('admin.plataformas.index')->with('success', 'Plataforma actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Plataforma $plataforma)
    {
        if ($plataforma->videojuegos()->exists() || $plataforma->variantes()->exists()) {
            throw ValidationException::withMessages([
                'plataforma' => 'No se puede eliminar este registro porque está en uso.',
            ]);
        }

        $plataforma->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Plataforma eliminada correctamente.']);
        }

        return redirect()->route('admin.plataformas.index')->with('success', 'Plataforma eliminada correctamente.');
    }
}
