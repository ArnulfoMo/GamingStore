
@extends('layouts.admin')

@section('titulo', 'Detalle del pago')
@section('page-title', 'Detalle del pago')

@section('contenido')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <p class="text-muted mb-0">
                Información de la transacción #{{ $pago->id }}
            </p>
        </div>

        <a href="{{ route('admin.pagos.index') }}"
           class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>

    </div>

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Información de la transacción
                    </h6>
                </div>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <small class="text-muted">ID del pago</small>
                            <h5>#{{ $pago->id }}</h5>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted">ID de venta</small>
                            <h5>#{{ $pago->venta_id }}</h5>
                        </div>

                    </div>

                    <hr>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <small class="text-muted">Tipo de pago</small>
                            <h6>{{ $pago->tipo_pago }}</h6>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted">Monto</small>
                            <h4 class="text-success">
                                L {{ number_format($pago->monto, 2) }}
                            </h4>
                        </div>

                    </div>

                    <hr>

                    <div class="mb-3">
                        <small class="text-muted">
                            Referencia de transacción
                        </small>

                        <p class="mb-0">
                            {{ $pago->referencia_transaccion ?? 'No disponible' }}
                        </p>
                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">
                            <small class="text-muted">Fecha de pago</small>
                            <p>
                                {{ $pago->fecha_pago ?? 'No registrada' }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted">Fecha de registro</small>
                            <p>
                                {{ $pago->created_at ?? 'No disponible' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Estado del pago
                    </h6>
                </div>

                <div class="card-body text-center">

                    @if($pago->estado == 1)

                        <i class="fas fa-check-circle fa-4x text-success mb-3"></i>

                        <h5 class="text-success">Pago aprobado</h5>

                        <p class="text-muted">
                            La transacción fue aprobada.
                        </p>

                    @elseif($pago->estado == 0)

                        <i class="fas fa-clock fa-4x text-warning mb-3"></i>

                        <h5 class="text-warning">Pago pendiente</h5>

                        <p class="text-muted">
                            La transacción está pendiente de confirmación.
                        </p>

                    @else

                        <i class="fas fa-times-circle fa-4x text-danger mb-3"></i>

                        <h5 class="text-danger">Pago rechazado</h5>

                        <p class="text-muted">
                            La transacción fue rechazada.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
