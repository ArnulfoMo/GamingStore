<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneroRequest;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $generos = Genero::orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.generos.partials.tabla', compact('generos'));
        }

        return view('admin.generos.index', compact('generos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genero = new Genero;

        return view('admin.generos.create', compact('genero'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GeneroRequest $request)
    {
        Genero::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Género registrado correctamente.'], 201);
        }

        return redirect()->route('admin.generos.index')->with('success', 'Género registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genero $genero)
    {
        return view('admin.generos.show', compact('genero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genero $genero)
    {
        return view('admin.generos.edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GeneroRequest $request, Genero $genero)
    {
        $genero->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Género actualizado correctamente.']);
        }

        return redirect()->route('admin.generos.index')->with('success', 'Género actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Genero $genero)
    {
        if ($genero->videojuegos()->exists()) {
            throw ValidationException::withMessages([
                'genero' => 'No se puede eliminar este registro porque está en uso.',
            ]);
        }

        $genero->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Género eliminado correctamente.']);
        }

        return redirect()->route('admin.generos.index')->with('success', 'Género eliminado correctamente.');
    }
}
