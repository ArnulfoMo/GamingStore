@extends('layouts.admin')

@section('titulo', 'Gestión de pagos')

@section('contenido')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Gestión de pagos</h1>
            <p class="text-muted mb-0">
                Consulta y supervisa las transacciones realizadas.
            </p>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total de pagos
                    </div>
                    <div class="h4 mb-0 font-weight-bold">
                        {{ $totalPagos ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Pagos aprobados
                    </div>
                    <div class="h4 mb-0 font-weight-bold">
                        {{ $pagosAprobados ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Pendientes
                    </div>
                    <div class="h4 mb-0 font-weight-bold">
                        {{ $pagosPendientes ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Pagos rechazados
                    </div>
                    <div class="h4 mb-0 font-weight-bold">
                        {{ $pagosRechazados ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Registro de transacciones
            </h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.pagos.index') }}"
                  method="GET"
                  class="row mb-4">

                <div class="col-md-5 mb-2">
                    <input
                        type="text"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar por referencia o venta..."
                        value="{{ request('buscar') }}">
                </div>

                <div class="col-md-4 mb-2">
                    <select name="estado" class="form-control">
                        <option value="">Todos los estados</option>
                        <option value="1" {{ request('estado') == '1' ? 'selected' : '' }}>
                            Aprobado
                        </option>
                        <option value="0" {{ request('estado') == '0' ? 'selected' : '' }}>
                            Pendiente
                        </option>
                        <option value="2" {{ request('estado') == '2' ? 'selected' : '' }}>
                            Rechazado
                        </option>
                    </select>
                </div>

                <div class="col-md-3 mb-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
                    </button>

                    <a href="{{ route('admin.pagos.index') }}"
                       class="btn btn-secondary">
                        Limpiar
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Venta</th>
                            <th>Tipo de pago</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pagos as $pago)
                            <tr>
                                <td>{{ $pago->id }}</td>

                                <td>
                                    #{{ $pago->venta_id }}
                                </td>

                                <td>
                                    {{ $pago->tipo_pago }}
                                </td>

                                <td>
                                    L {{ number_format($pago->monto, 2) }}
                                </td>

                                <td>
                                    @if($pago->estado == 1)
                                        <span class="badge badge-success">
                                            Aprobado
                                        </span>
                                    @elseif($pago->estado == 0)
                                        <span class="badge badge-warning">
                                            Pendiente
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            Rechazado
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $pago->fecha_pago }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.pagos.show', $pago->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No hay pagos registrados.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="d-flex justify-content-end">
                {{ $pagos->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
