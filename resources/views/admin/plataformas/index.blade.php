@extends('layouts.admin')

@section('titulo', 'Plataformas')
@section('page-title', 'Plataformas')

@section('page-actions')
<a href="{{ route('admin.plataformas.create') }}" class="btn btn-primary" data-catalogo-modal data-titulo="Nueva plataforma"><i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Nueva plataforma</a>
@endsection

@section('contenido')
<div id="catalogo-status" class="alert d-none" role="status" aria-live="polite"></div>
<div class="card">
    <div class="card-body">
        <div data-catalogo-lista data-url="{{ route('admin.plataformas.index') }}">
            @include('admin.plataformas.partials.tabla')
        </div>
    </div>
</div>
@include('admin.partials.modal-catalogos')
@endsection

@push('scripts')
<script src="{{ asset('admin-assets/js/catalogos.js') }}?v={{ filemtime(public_path('admin-assets/js/catalogos.js')) }}"></script>
@endpush
