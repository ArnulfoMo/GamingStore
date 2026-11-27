@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Editar categoría')
@section('page-title', 'Editar categoría')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST" data-catalogo-form>
            @csrf
            @method('PUT')
            @include('admin.categorias.partials.form')
        </form>
    </div>
</div>
@endsection
