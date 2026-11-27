@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Detalle de desarrollador')
@section('page-title', 'Detalle de desarrollador')

@section('contenido')
<div class="card">
    <div class="card-body">
        <dl class="row text-break">
            <dt class="col-sm-4">Nombre</dt>
            <dd class="col-sm-8">{{ $desarrollador->nombre }}</dd>
        </dl>
        <div class="d-flex flex-wrap justify-content-end gap-2">
            <a href="{{ route('admin.desarrolladores.index') }}" class="btn btn-outline-light" data-catalogo-cerrar>Volver</a>
            <a href="{{ route('admin.desarrolladores.edit', $desarrollador) }}" class="btn btn-primary" data-catalogo-modal data-titulo="Editar desarrollador">Editar</a>
        </div>
    </div>
</div>
@endsection
