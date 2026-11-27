@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Nuevo género')
@section('page-title', 'Nuevo género')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.generos.store') }}" method="POST" data-catalogo-form>
            @csrf
            @include('admin.generos.partials.form')
        </form>
    </div>
</div>
@endsection
