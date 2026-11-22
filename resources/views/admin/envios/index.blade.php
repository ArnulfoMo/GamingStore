@extends('layouts.admin')

@section('titulo', 'Gestión de envíos')
@section('page-title', 'Gestión de envíos')

@section('contenido')

@php
    $estados = [
        0 => ['nombre' => 'Pendiente', 'clase' => 'bg-warning text-dark', 'icono' => 'bi-clock'],
        1 => ['nombre' => 'En tránsito', 'clase' => 'bg-info text-dark', 'icono' => 'bi-truck'],
        2 => ['nombre' => 'Entregado', 'clase' => 'bg-success', 'icono' => 'bi-check-circle'],
        3 => ['nombre' => 'Incidencia', 'clase' => 'bg-danger', 'icono' => 'bi-exclamation-triangle'],
    ];
@endphp

<div class="row g-3 mb-4">

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total de envíos</p>
                    <h3 class="mb-0">{{ $totalEnvios }}</h3>
                </div>
                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                    <i class="bi bi-box-seam text-primary fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Pendientes</p>
                    <h3 class="mb-0">{{ $enviosPendientes }}</h3>
                </div>
                <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                    <i class="bi bi-clock text-warning fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">En tránsito</p>
                    <h3 class="mb-0">{{ $enviosEnTransito }}</h3>
                </div>
                <div class="rounded-circle bg-info bg-opacity-10 p-3">
                    <i class="bi bi-truck text-info fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Entregados</p>
                    <h3 class="mb-0">{{ $enviosEntregados }}</h3>
                </div>
                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                    <i class="bi bi-check-circle text-success fs-3"></i>
                </div>
            </div>
        </div>
    </div>

</div>

@if($enviosConIncidencia > 0)
    <div class="alert alert-danger d-flex align-items-center mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        Hay {{ $enviosConIncidencia }} envío(s) con incidencia que requieren atención.
    </div>
@endif

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3">
        <h5 class="mb-0">
            <i class="bi bi-truck me-2"></i>
            Registro de envíos
        </h5>
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('admin.envios.index') }}" class="mb-4">

            <div class="row g-3">

                <div class="col-lg-4">
                    <label class="form-label">Buscar envío</label>
                    <input
                        type="text"
                        name="buscar"
                        class="form-control"
                        placeholder="Número de seguimiento o venta"
                        value="{{ request('buscar') }}"
                    >
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        @foreach($estados as $codigo => $estado)
                            <option value="{{ $codigo }}"
                                {{ request('estado') !== null && request('estado') == $codigo ? 'selected' : '' }}>
                                {{ $estado['nombre'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Sucursal ID</label>
                    <input
                        type="number"
                        name="sucursal_id"
                        class="form-control"
                        min="1"
                        placeholder="ID sucursal"
                        value="{{ request('sucursal_id') }}"
                    >
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Desde</label>
                    <input type="date" name="desde" class="form-control"
                        value="{{ request('desde') }}">
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Hasta</label>
                    <input type="date" name="hasta" class="form-control"
                        value="{{ request('hasta') }}">
                </div>

                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i> Buscar
                    </button>

                    <a href="{{ route('admin.envios.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Limpiar
                    </a>
                </div>

            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>Seguimiento</th>
                        <th>Venta</th>
                        <th>Sucursal</th>
                        <th>Estado</th>
                        <th>Fecha despacho</th>
                        <th>Fecha entrega</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($envios as $envio)
                        @php
                            $estado = $estados[$envio->estado] ?? [
                                'nombre' => 'Desconocido',
                                'clase' => 'bg-secondary',
                                'icono' => 'bi-question-circle'
                            ];
                        @endphp

                        <tr>
                            <td>
                                <span class="fw-semibold">
                                    {{ $envio->numero_seguimiento }}
                                </span>
                            </td>

                            <td>#{{ $envio->venta_id }}</td>

                            <td>#{{ $envio->sucursal_id }}</td>

                            <td>
                                <span class="badge {{ $estado['clase'] }}">
                                    <i class="bi {{ $estado['icono'] }} me-1"></i>
                                    {{ $estado['nombre'] }}
                                </span>
                            </td>

                            <td>
                                {{ $envio->fecha_despacho?->format('d/m/Y H:i') ?? 'Sin despacho' }}
                            </td>

                            <td>
                                {{ $envio->fecha_entrega?->format('d/m/Y H:i') ?? 'Pendiente' }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.envios.show', $envio) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                    Ver
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                                <p class="text-muted mb-0">No se encontraron envíos.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
            <span class="text-muted small">
                Mostrando {{ $envios->firstItem() ?? 0 }}
                - {{ $envios->lastItem() ?? 0 }}
                de {{ $envios->total() }} registros
            </span>

            {{ $envios->links() }}
        </div>

    </div>
</div>

@endsection