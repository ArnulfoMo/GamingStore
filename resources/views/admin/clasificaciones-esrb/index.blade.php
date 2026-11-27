@extends('layouts.admin')

@section('titulo', 'Clasificaciones ESRB')
@section('page-title', 'Clasificaciones ESRB')

@section('page-actions')
<a href="{{ route('admin.clasificaciones-esrb.create') }}" class="btn btn-primary" data-catalogo-modal data-titulo="Nueva clasificación ESRB"><i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Nueva clasificación ESRB</a>
@endsection

@section('contenido')
<div id="catalogo-status" class="alert d-none" role="status" aria-live="polite"></div>
<div class="card">
    <div class="card-body">
        <div data-catalogo-lista data-url="{{ route('admin.clasificaciones-esrb.index') }}">
            @include('admin.clasificaciones-esrb.partials.tabla')
        </div>
    </div>
</div>
@include('admin.partials.modal-catalogos')
@endsection

@push('scripts')
<script src="{{ asset('admin-assets/js/catalogos.js') }}?v={{ filemtime(public_path('admin-assets/js/catalogos.js')) }}"></script>
@endpush
