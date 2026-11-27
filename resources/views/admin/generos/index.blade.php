@extends('layouts.admin')

@section('titulo', 'Géneros')
@section('page-title', 'Géneros')

@section('page-actions')
<a href="{{ route('admin.generos.create') }}" class="btn btn-primary" data-catalogo-modal data-titulo="Nuevo género"><i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Nuevo género</a>
@endsection

@section('contenido')
<div id="catalogo-status" class="alert d-none" role="status" aria-live="polite"></div>
<div class="card">
    <div class="card-body">
        <div data-catalogo-lista data-url="{{ route('admin.generos.index') }}">
            @include('admin.generos.partials.tabla')
        </div>
    </div>
</div>
@include('admin.partials.modal-catalogos')
@endsection

@push('scripts')
<script src="{{ asset('admin-assets/js/catalogos.js') }}?v={{ filemtime(public_path('admin-assets/js/catalogos.js')) }}"></script>
@endpush
