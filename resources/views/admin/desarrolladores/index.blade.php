@extends('layouts.admin')

@section('titulo', 'Desarrolladores')
@section('page-title', 'Desarrolladores')

@section('page-actions')
<a href="{{ route('admin.desarrolladores.create') }}" class="btn btn-primary" data-catalogo-modal data-titulo="Nuevo desarrollador"><i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Nuevo desarrollador</a>
@endsection

@section('contenido')
<div id="catalogo-status" class="alert d-none" role="status" aria-live="polite"></div>
<div class="card">
    <div class="card-body">
        <div data-catalogo-lista data-url="{{ route('admin.desarrolladores.index') }}">
            @include('admin.desarrolladores.partials.tabla')
        </div>
    </div>
</div>
@include('admin.partials.modal-catalogos')
@endsection

@push('scripts')
<script src="{{ asset('admin-assets/js/catalogos.js') }}?v={{ filemtime(public_path('admin-assets/js/catalogos.js')) }}"></script>
@endpush
