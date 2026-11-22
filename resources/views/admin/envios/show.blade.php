@extends('layouts.admin')

@section('titulo', 'Detalle del envío')
@section('page-title', 'Detalle del envío')

@section('contenido')

@php
    $estados = [
        0 => ['nombre' => 'Pendiente', 'clase' => 'warning', 'icono' => 'bi-clock'],
        1 => ['nombre' => 'En tránsito', 'clase' => 'info', 'icono' => 'bi-truck'],
        2 => ['nombre' => 'Entregado', 'clase' => 'success', 'icono' => 'bi-check-circle'],
        3 => ['nombre' => 'Incidencia', 'clase' => 'danger', 'icono' => 'bi-exclamation-triangle'],
    ];

    $estado = $estados[$envio->estado] ?? [
        'nombre' => 'Desconocido',
        'clase' => 'secondary',
        'icono' => 'bi-question-circle'
    ];
@endphp

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

    <div>
        <p class="text-muted mb-1">Número de seguimiento</p>
        <h4 class="mb-0">{{ $envio->numero_seguimiento }}</h4>
    </div>

    <a href="{{ route('admin.envios.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Volver a envíos
    </a>

</div>

<div class="row g-4">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Información del envío
                </h5>
            </div>

            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">
                        <small class="text-muted d-block">ID del envío</small>
                        <span class="fw-semibold">#{{ $envio->id }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block">Número de seguimiento</small>
                        <span class="fw-semibold">{{ $envio->numero_seguimiento }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block">Venta relacionada</small>
                        <span class="fw-semibold">#{{ $envio->venta_id }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block">Sucursal responsable</small>
                        <span class="fw-semibold">#{{ $envio->sucursal_id }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block">Fecha de despacho</small>
                        <span class="fw-semibold">
                            {{ $envio->fecha_despacho?->format('d/m/Y H:i') ?? 'No registrado' }}
                        </span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block">Fecha de entrega</small>
                        <span class="fw-semibold">
                            {{ $envio->fecha_entrega?->format('d/m/Y H:i') ?? 'No entregado' }}
                        </span>
                    </div>

                    <div class="col-12">
                        <small class="text-muted d-block mb-2">Observaciones</small>

                        <div class="bg-light rounded p-3">
                            {{ $envio->observaciones ?: 'No hay observaciones registradas.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Estado actual</h5>
            </div>

            <div class="card-body text-center py-4">

                <div class="rounded-circle bg-{{ $estado['clase'] }} bg-opacity-10
                            d-inline-flex align-items-center justify-content-center mb-3"
                     style="width: 85px; height: 85px;">
                    <i class="bi {{ $estado['icono'] }} text-{{ $estado['clase'] }}"
                       style="font-size: 2.5rem;"></i>
                </div>

                <h5>
                    <span class="badge bg-{{ $estado['clase'] }} {{ $envio->estado == 0 ? 'text-dark' : '' }}">
                        {{ $estado['nombre'] }}
                    </span>
                </h5>

                <p class="text-muted small mb-0">
                    Estado registrado para este envío.
                </p>

            </div>
        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Información del registro</h5>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <small class="text-muted d-block">Creado el</small>
                    <span>
                        {{ $envio->created_at?->format('d/m/Y H:i:s') ?? 'No disponible' }}
                    </span>
                </div>

                <div>
                    <small class="text-muted d-block">Última actualización</small>
                    <span>
                        {{ $envio->updated_at?->format('d/m/Y H:i:s') ?? 'No disponible' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection