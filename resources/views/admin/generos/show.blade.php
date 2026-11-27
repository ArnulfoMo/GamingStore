@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Detalle de género')
@section('page-title', 'Detalle de género')

@section('contenido')
<div class="card">
    <div class="card-body">
        <dl class="row text-break">
            <dt class="col-sm-4">Nombre</dt>
            <dd class="col-sm-8">{{ $genero->nombre }}</dd>
        </dl>
        <div class="d-flex flex-wrap justify-content-end gap-2">
            <a href="{{ route('admin.generos.index') }}" class="btn btn-outline-light" data-catalogo-cerrar>Volver</a>
            <a href="{{ route('admin.generos.edit', $genero) }}" class="btn btn-primary" data-catalogo-modal data-titulo="Editar género">Editar</a>
        </div>
    </div>
</div>
@endsection
