@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Editar desarrollador')
@section('page-title', 'Editar desarrollador')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.desarrolladores.update', $desarrollador) }}" method="POST" data-catalogo-form>
            @csrf
            @method('PUT')
            @include('admin.desarrolladores.partials.form')
        </form>
    </div>
</div>
@endsection
