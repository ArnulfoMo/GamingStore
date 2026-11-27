@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Nueva categoría')
@section('page-title', 'Nueva categoría')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categorias.store') }}" method="POST" data-catalogo-form>
            @csrf
            @include('admin.categorias.partials.form')
        </form>
    </div>
</div>
@endsection
