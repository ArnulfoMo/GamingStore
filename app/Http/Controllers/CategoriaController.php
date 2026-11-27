<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.categorias.partials.tabla', compact('categorias'));
        }

        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoria = new Categoria;

        return view('admin.categorias.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        Categoria::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Categoría registrada correctamente.'], 201);
        }

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Categoría actualizada correctamente.']);
        }

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Categoria $categoria)
    {
        if ($categoria->productos()->exists()) {
            throw ValidationException::withMessages([
                'categoria' => 'No se puede eliminar este registro porque está en uso.',
            ]);
        }

        $categoria->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Categoría eliminada correctamente.']);
        }

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
