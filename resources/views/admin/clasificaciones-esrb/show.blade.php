@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Detalle de clasificación ESRB')
@section('page-title', 'Detalle de clasificación ESRB')

@section('contenido')
<div class="card">
    <div class="card-body">
        <dl class="row text-break">
            <dt class="col-sm-4">Código</dt>
            <dd class="col-sm-8">{{ $clasificacion->codigo }}</dd>
            <dt class="col-sm-4">Nombre</dt>
            <dd class="col-sm-8">{{ $clasificacion->nombre }}</dd>
            <dt class="col-sm-4">Edad mínima</dt>
            <dd class="col-sm-8">{{ $clasificacion->edad_minima }}</dd>
            <dt class="col-sm-4">Descripción</dt>
            <dd class="col-sm-8">{{ $clasificacion->descripcion ?: 'Sin especificar' }}</dd>
        </dl>
        <div class="d-flex flex-wrap justify-content-end gap-2">
            <a href="{{ route('admin.clasificaciones-esrb.index') }}" class="btn btn-outline-light" data-catalogo-cerrar>Volver</a>
            <a href="{{ route('admin.clasificaciones-esrb.edit', $clasificacion) }}" class="btn btn-primary" data-catalogo-modal data-titulo="Editar clasificación ESRB">Editar</a>
        </div>
    </div>
</div>
@endsection
