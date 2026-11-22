@extends('layouts.admin')

@section('titulo', 'Gestión de facturas')
@section('page-title', 'Gestión de facturas')

@section('page-actions')
    <span class="badge bg-primary fs-6">
        <i class="bi bi-receipt"></i> Facturación
    </span>
@endsection

@section('contenido')

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-start border-primary border-4 shadow h-100">
                <div class="card-body">
                    <div class="text-xs fw-bold text-primary text-uppercase mb-2">
                        Total de facturas
                    </div>
                    <div class="h4 mb-0 fw-bold">
                        {{ $totalFacturas }}
                    </div>
                    <small class="text-muted">Comprobantes registrados</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-start border-success border-4 shadow h-100">
                <div class="card-body">
                    <div class="text-xs fw-bold text-success text-uppercase mb-2">
                        Facturas emitidas
                    </div>
                    <div class="h4 mb-0 fw-bold">
                        {{ $facturasEmitidas }}
                    </div>
                    <small class="text-muted">Facturación vigente</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-start border-danger border-4 shadow h-100">
                <div class="card-body">
                    <div class="text-xs fw-bold text-danger text-uppercase mb-2">
                        Facturas anuladas
                    </div>
                    <div class="h4 mb-0 fw-bold">
                        {{ $facturasAnuladas }}
                    </div>
                    <small class="text-muted">Comprobantes anulados</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-start border-info border-4 shadow h-100">
                <div class="card-body">
                    <div class="text-xs fw-bold text-info text-uppercase mb-2">
                        Total facturado
                    </div>
                    <div class="h4 mb-0 fw-bold">
                        L {{ number_format($montoFacturado, 2) }}
                    </div>
                    <small class="text-muted">Facturas emitidas</small>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-primary">
                <i class="bi bi-receipt-cutoff me-2"></i>
                Registro de facturación
            </h6>

            <span class="text-muted small">
                {{ $facturas->total() }} registros encontrados
            </span>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.facturas.index') }}"
                  method="GET"
                  class="row align-items-end mb-4">

                <div class="col-lg-4 col-md-6 mb-3">
                    <label class="form-label">Buscar factura</label>
                    <input
                        type="text"
                        name="buscar"
                        class="form-control"
                        placeholder="Número, RTN o cliente..."
                        value="{{ request('buscar') }}">
                </div>

                <div class="col-lg-2 col-md-6 mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="1" @selected(request('estado') === '1')>
                            Emitida
                        </option>
                        <option value="0" @selected(request('estado') === '0')>
                            Anulada
                        </option>
                    </select>
                </div>

                <div class="col-lg-2 col-md-6 mb-3">
                    <label class="form-label">Desde</label>
                    <input
                        type="date"
                        name="desde"
                        class="form-control"
                        value="{{ request('desde') }}">
                </div>

                <div class="col-lg-2 col-md-6 mb-3">
                    <label class="form-label">Hasta</label>
                    <input
                        type="date"
                        name="hasta"
                        class="form-control"
                        value="{{ request('hasta') }}">
                </div>

                <div class="col-lg-2 col-md-12 mb-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>

                    <a href="{{ route('admin.facturas.index') }}"
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>N.º Factura</th>
                            <th>Venta</th>
                            <th>Cliente</th>
                            <th>RTN cliente</th>
                            <th>Subtotal</th>
                            <th>ISV</th>
                            <th>Total</th>
                            <th>Emisión</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($facturas as $factura)

                            <tr>
                                <td class="fw-bold">
                                    {{ $factura->numero_factura }}
                                </td>

                                <td>
                                    #{{ $factura->venta_id }}
                                </td>

                                <td>
                                    {{ $factura->nombre_cliente ?? 'Consumidor final' }}
                                </td>

                                <td>
                                    {{ $factura->RTN_cliente ?? 'No registrado' }}
                                </td>

                                <td>
                                    L {{ number_format($factura->subtotal, 2) }}
                                </td>

                                <td>
                                    L {{ number_format($factura->ISV, 2) }}
                                </td>

                                <td class="fw-bold">
                                    L {{ number_format($factura->total, 2) }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y') }}
                                </td>

                                <td>
                                    @if($factura->estado == 1)
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i>
                                            Emitida
                                        </span>
                                    @elseif($factura->estado == 0)
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle"></i>
                                            Anulada
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Desconocido
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.facturas.show', $factura->id) }}"
                                       class="btn btn-info btn-sm"
                                       title="Ver factura">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="10" class="text-center py-4">
                                    <i class="bi bi-receipt text-muted fs-1 d-block mb-2"></i>
                                    <span class="text-muted">
                                        No se encontraron facturas registradas.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

                <small class="text-muted">
                    Mostrando {{ $facturas->firstItem() ?? 0 }}
                    - {{ $facturas->lastItem() ?? 0 }}
                    de {{ $facturas->total() }} facturas
                </small>

                {{ $facturas->links() }}

            </div>

        </div>
    </div>

</div>

@endsection