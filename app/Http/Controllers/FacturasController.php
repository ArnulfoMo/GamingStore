<?php

namespace App\Http\Controllers;

use App\Models\facturas;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $consulta = Facturas::query();

        // Búsqueda
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $consulta->where(function ($q) use ($buscar) {
                $q->where('numero_factura', 'like', "%{$buscar}%")
                  ->orWhere('nombre_cliente', 'like', "%{$buscar}%")
                  ->orWhere('RTN_cliente', 'like', "%{$buscar}%")
                  ->orWhere('venta_id', $buscar);
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $consulta->where('estado', $request->estado);
        }

        // Filtro por fecha inicial
        if ($request->filled('desde')) {
            $consulta->whereDate('fecha_emision', '>=', $request->desde);
        }

        // Filtro por fecha final
        if ($request->filled('hasta')) {
            $consulta->whereDate('fecha_emision', '<=', $request->hasta);
        }

        $facturas = $consulta
            ->orderByDesc('fecha_emision')
            ->paginate(10)
            ->withQueryString();

        // Indicadores generales
        $totalFacturas = Facturas::count();

        $facturasEmitidas = Facturas::where('estado', 1)->count();

        $facturasAnuladas = Facturas::where('estado', 0)->count();

        $montoFacturado = Facturas::where('estado', 1)->sum('total');

        return view('admin.facturas.index', compact(
            'facturas',
            'totalFacturas',
            'facturasEmitidas',
            'facturasAnuladas',
            'montoFacturado'
        ));
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
    public function show(facturas $facturas)
    {
        return view('admin.facturas.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(facturas $facturas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, facturas $facturas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(facturas $facturas)
    {
        //
    }
}