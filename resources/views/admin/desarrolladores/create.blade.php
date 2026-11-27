@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Nuevo desarrollador')
@section('page-title', 'Nuevo desarrollador')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.desarrolladores.store') }}" method="POST" data-catalogo-form>
            @csrf
            @include('admin.desarrolladores.partials.form')
        </form>
    </div>
</div>
@endsection
