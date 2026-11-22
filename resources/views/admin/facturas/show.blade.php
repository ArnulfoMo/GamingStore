
@extends('layouts.admin')

@section('titulo', 'Detalle de factura')
@section('page-title', 'Detalle de factura')

@section('page-actions')

    <a href="{{ route('admin.facturas.index') }}"
       class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Volver
    </a>

    <button type="button"
            onclick="window.print()"
            class="btn btn-primary btn-sm">
        <i class="bi bi-printer"></i> Imprimir
    </button>

@endsection

@section('contenido')

<div class="container-fluid">

    <div class="card shadow mb-4">

        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>
                <h5 class="fw-bold mb-1">
                    Factura {{ $factura->numero_factura }}
                </h5>

                <p class="text-muted mb-0">
                    Emitida el
                    {{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y H:i') }}
                </p>
            </div>

            <div>
                @if($factura->estado == 1)

                    <span class="badge bg-success fs-6">
                        <i class="bi bi-check-circle"></i> Emitida
                    </span>

                @elseif($factura->estado == 0)

                    <span class="badge bg-danger fs-6">
                        <i class="bi bi-x-circle"></i> Anulada
                    </span>

                @else

                    <span class="badge bg-secondary fs-6">
                        Estado desconocido
                    </span>

                @endif
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Información del comprobante fiscal
                    </h6>
                </div>

                <div class="card-body">

                    <div class="text-center mb-4">
                        <small class="text-muted text-uppercase">
                            Número de factura
                        </small>

                        <h3 class="fw-bold text-primary">
                            {{ $factura->numero_factura }}
                        </h3>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-building me-2"></i>
                        Datos del emisor
                    </h6>

                    <div class="row mb-4">

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">RTN del emisor</small>
                            <p class="fw-semibold mb-0">
                                {{ $factura->RTN_emisor }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">CAI</small>
                            <p class="fw-semibold mb-0">
                                {{ $factura->CAI }}
                            </p>
                        </div>

                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-person me-2"></i>
                        Datos del cliente
                    </h6>

                    <div class="row mb-4">

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Nombre del cliente</small>
                            <p class="fw-semibold mb-0">
                                {{ $factura->nombre_cliente ?? 'Consumidor final' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">RTN del cliente</small>
                            <p class="fw-semibold mb-0">
                                {{ $factura->RTN_cliente ?? 'No registrado' }}
                            </p>
                        </div>

                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-cart-check me-2"></i>
                        Información de la venta
                    </h6>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Identificador de venta</small>
                            <p class="fw-semibold mb-0">
                                #{{ $factura->venta_id }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Rango de facturación</small>
                            <p class="fw-semibold mb-0">
                                #{{ $factura->rango_facturacion_id }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">ID de factura</small>
                            <p class="fw-semibold mb-0">
                                #{{ $factura->id }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Fecha y hora de emisión</small>
                            <p class="fw-semibold mb-0">
                                {{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y H:i:s') }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="bi bi-calculator me-2"></i>
                        Resumen económico
                    </h6>
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold">
                            L {{ number_format($factura->subtotal, 2) }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Descuento</span>
                        <span class="text-danger">
                            - L {{ number_format($factura->descuento, 2) }}
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">
                            ISV ({{ number_format($factura->tasa_isv * 100, 2) }}%)
                        </span>

                        <span class="fw-semibold">
                            L {{ number_format($factura->ISV, 2) }}
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">TOTAL</span>

                        <h4 class="fw-bold text-success mb-0">
                            L {{ number_format($factura->total, 2) }}
                        </h4>
                    </div>

                </div>
            </div>

            {{-- Información adicional --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        Información fiscal
                    </h6>
                </div>

                <div class="card-body">

                    <div class="mb-3">
                        <small class="text-muted">CAI</small>
                        <p class="small fw-semibold mb-0">
                            {{ $factura->CAI }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Rango de facturación</small>
                        <p class="fw-semibold mb-0">
                            #{{ $factura->rango_facturacion_id }}
                        </p>
                    </div>

                    <div>
                        <small class="text-muted">Estado del comprobante</small>
                        <p class="fw-semibold mb-0">
                            {{ $factura->estado == 1 ? 'Emitida' : ($factura->estado == 0 ? 'Anulada' : 'Desconocido') }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection