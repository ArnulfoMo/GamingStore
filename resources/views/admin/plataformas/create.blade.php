@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Nueva plataforma')
@section('page-title', 'Nueva plataforma')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.plataformas.store') }}" method="POST" data-catalogo-form>
            @csrf
            @include('admin.plataformas.partials.form')
        </form>
    </div>
</div>
@endsection
