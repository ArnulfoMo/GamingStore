<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideojuegosController extends Controller
{

    public function index()
    {
        $empleados =Videojuegos::latest()->paginate(10);

        return view('admin.videojuegos.index',compact('videojuegos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.videojuegos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'nombre'        =>  'required|string|max:180',
        'descripcion'             =>  'nullable|string',
        'portada'                =>  'nullable|string|max:255',
        'trailer'                =>  'nullable|string|max:255',
        'requisitos_tecnicos'    =>  'nullable|string',
        'fecha_lanzamiento'      =>  'nullable|date',
        'es_preventa'             => 'required|integer|in:0,1',
        'clasificacion_esrb_id'   => 'required|exists:clasificaciones_esrb,id',
        'activo'                  => 'required|integer|in:0,1',
        ]);

        Empleados::create($request->all());

        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success', 'Videojuego ingresado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuegos $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(videojuegos $empleados)
    {
        return view('admin.videojuegos.edit',compact('videojuegos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuegos $empleados)
    {
    $request->validate([
        'nombre'        =>  'required|string|max:180',
        'descripcion'             =>  'nullable|string',
        'portada'                =>  'nullable|string|max:255',
        'trailer'                =>  'nullable|string|max:255',
        'requisitos_tecnicos'    =>  'nullable|string',
        'fecha_lanzamiento'      =>  'nullable|date',
        'es_preventa'             => 'required|integer|in:0,1',
        'clasificacion_esrb_id'   => 'required|exists:clasificaciones_esrb,id',
        'activo'                  => 'required|integer|in:0,1',
        
        ]);

        $videojuegos->update($request->all());

        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success', 'videojuego actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuegos $empleados)
    {
        $empleados->delete();

        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success', 'Videojuego eliminado');
    }
}
