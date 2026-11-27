@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Detalle de categoría')
@section('page-title', 'Detalle de categoría')

@section('contenido')
<div class="card">
    <div class="card-body">
        <dl class="row text-break">
            <dt class="col-sm-4">Nombre</dt>
            <dd class="col-sm-8">{{ $categoria->nombre }}</dd>
            <dt class="col-sm-4">Descripción</dt>
            <dd class="col-sm-8">{{ $categoria->descripcion ?: 'Sin especificar' }}</dd>
            <dt class="col-sm-4">Estado</dt>
            <dd class="col-sm-8">{{ $categoria->activo ? 'Activo' : 'Inactivo' }}</dd>
        </dl>
        <div class="d-flex flex-wrap justify-content-end gap-2">
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-light" data-catalogo-cerrar>Volver</a>
            <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn btn-primary" data-catalogo-modal data-titulo="Editar categoría">Editar</a>
        </div>
    </div>
</div>
@endsection
