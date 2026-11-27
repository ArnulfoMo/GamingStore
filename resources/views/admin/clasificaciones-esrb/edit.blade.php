@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Editar clasificación ESRB')
@section('page-title', 'Editar clasificación ESRB')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.clasificaciones-esrb.update', $clasificacion) }}" method="POST" data-catalogo-form>
            @csrf
            @method('PUT')
            @include('admin.clasificaciones-esrb.partials.form')
        </form>
    </div>
</div>
@endsection
