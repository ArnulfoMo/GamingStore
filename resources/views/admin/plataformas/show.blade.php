@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Detalle de plataforma')
@section('page-title', 'Detalle de plataforma')

@section('contenido')
<div class="card">
    <div class="card-body">
        <dl class="row text-break">
            <dt class="col-sm-4">Nombre</dt>
            <dd class="col-sm-8">{{ $plataforma->nombre }}</dd>
            <dt class="col-sm-4">Descripción</dt>
            <dd class="col-sm-8">{{ $plataforma->descripcion ?: 'Sin especificar' }}</dd>
            <dt class="col-sm-4">Logo (ruta o URL)</dt>
            <dd class="col-sm-8">{{ $plataforma->logo ?: 'Sin especificar' }}</dd>
            <dt class="col-sm-4">Estado</dt>
            <dd class="col-sm-8">{{ $plataforma->activo ? 'Activo' : 'Inactivo' }}</dd>
        </dl>
        <div class="d-flex flex-wrap justify-content-end gap-2">
            <a href="{{ route('admin.plataformas.index') }}" class="btn btn-outline-light" data-catalogo-cerrar>Volver</a>
            <a href="{{ route('admin.plataformas.edit', $plataforma) }}" class="btn btn-primary" data-catalogo-modal data-titulo="Editar plataforma">Editar</a>
        </div>
    </div>
</div>
@endsection
