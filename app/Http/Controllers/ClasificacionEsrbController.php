<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasificacionEsrbRequest;
use App\Models\ClasificacionEsrb;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClasificacionEsrbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clasificaciones_esrb = ClasificacionEsrb::orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.clasificaciones-esrb.partials.tabla', compact('clasificaciones_esrb'));
        }

        return view('admin.clasificaciones-esrb.index', compact('clasificaciones_esrb'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clasificacion = new ClasificacionEsrb;

        return view('admin.clasificaciones-esrb.create', compact('clasificacion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClasificacionEsrbRequest $request)
    {
        ClasificacionEsrb::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Clasificación ESRB registrada correctamente.'], 201);
        }

        return redirect()->route('admin.clasificaciones-esrb.index')->with('success', 'Clasificación ESRB registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClasificacionEsrb $clasificacion)
    {
        return view('admin.clasificaciones-esrb.show', compact('clasificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClasificacionEsrb $clasificacion)
    {
        return view('admin.clasificaciones-esrb.edit', compact('clasificacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClasificacionEsrbRequest $request, ClasificacionEsrb $clasificacion)
    {
        $clasificacion->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Clasificación ESRB actualizada correctamente.']);
        }

        return redirect()->route('admin.clasificaciones-esrb.index')->with('success', 'Clasificación ESRB actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ClasificacionEsrb $clasificacion)
    {
        if ($clasificacion->videojuegos()->exists()) {
            throw ValidationException::withMessages([
                'clasificacion' => 'No se puede eliminar este registro porque está en uso.',
            ]);
        }

        $clasificacion->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Clasificación ESRB eliminada correctamente.']);
        }

        return redirect()->route('admin.clasificaciones-esrb.index')->with('success', 'Clasificación ESRB eliminada correctamente.');
    }
}
