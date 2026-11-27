@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Editar plataforma')
@section('page-title', 'Editar plataforma')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.plataformas.update', $plataforma) }}" method="POST" data-catalogo-form>
            @csrf
            @method('PUT')
            @include('admin.plataformas.partials.form')
        </form>
    </div>
</div>
@endsection
