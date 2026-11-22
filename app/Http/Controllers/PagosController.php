<?php

namespace App\Http\Controllers;

use App\Models\pagos;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $consulta = Pagos::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $consulta->where(function ($q) use ($buscar) {
                $q->where('referencia_transaccion', 'like', "%{$buscar}%")
                  ->orWhere('venta_id', $buscar);
            });
        }

        if ($request->filled('estado')) {
            $consulta->where('estado', $request->estado);
        }

        $pagos = $consulta->latest('fecha_pago')
            ->paginate(10)
            ->withQueryString();

        $totalPagos = Pagos::count();
        $pagosAprobados = Pagos::where('estado', 1)->count();
        $pagosPendientes = Pagos::where('estado', 0)->count();
        $pagosRechazados = Pagos::where('estado', 2)->count();

        return view('admin.pagos.index', compact(
            'pagos',
            'totalPagos',
            'pagosAprobados',
            'pagosPendientes',
            'pagosRechazados'
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
    public function show(pagos $pagos)
    {
        return view('admin.pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pagos $pagos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pagos $pagos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pagos $pagos)
    {
        //
    }
}
