@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Editar género')
@section('page-title', 'Editar género')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.generos.update', $genero) }}" method="POST" data-catalogo-form>
            @csrf
            @method('PUT')
            @include('admin.generos.partials.form')
        </form>
    </div>
</div>
@endsection
