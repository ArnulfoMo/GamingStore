@extends(request()->ajax() ? 'layouts.modal' : 'layouts.admin')

@section('titulo', 'Nueva clasificación ESRB')
@section('page-title', 'Nueva clasificación ESRB')

@section('contenido')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.clasificaciones-esrb.store') }}" method="POST" data-catalogo-form>
            @csrf
            @include('admin.clasificaciones-esrb.partials.form')
        </form>
    </div>
</div>
@endsection
