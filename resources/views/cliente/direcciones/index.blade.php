@extends('layouts.cliente')

@section('title', 'Mis direcciones — Gaming Store')

@section('content')
<div class="container py-4 py-md-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Mis direcciones</h1>
            <p class="text-muted mb-0">Guarda tus direcciones de entrega y elige tu dirección principal.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('perfil.edit') }}" class="btn btn-outline-secondary">Mi perfil</a>
            <a href="{{ route('direcciones.create') }}" class="btn btn-brand"><i class="fas fa-plus me-1" aria-hidden="true"></i>Agregar dirección</a>
        </div>
    </div>

    <div class="row g-3">
        @forelse ($direcciones as $direccion)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="mb-3">
                            @if ($direccion->pivot->principal)
                                <span class="badge text-bg-success mb-2"><i class="fas fa-check me-1" aria-hidden="true"></i>Principal</span>
                            @endif
                            <h2 class="h5 mb-1 text-break">{{ $direccion->ciudad }}</h2>
                            <p class="text-muted mb-0 text-break">{{ $direccion->departamento }}</p>
                        </div>
                        <div class="text-break mb-4">
                            @if ($direccion->colonia)
                                <p class="mb-1">{{ $direccion->colonia }}</p>
                            @endif
                            @if ($direccion->calle)
                                <p class="mb-1">{{ $direccion->calle }}</p>
                            @endif
                            @if ($direccion->referencia)
                                <p class="text-muted small mb-0">{{ $direccion->referencia }}</p>
                            @endif
                        </div>
                        <div class="mt-auto">
                            @if (! $direccion->pivot->principal)
                                <form action="{{ route('direcciones.principal', $direccion) }}" method="POST" class="mb-3">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Usar como principal</button>
                                </form>
                            @endif
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('direcciones.show', $direccion) }}" class="btn btn-outline-secondary btn-sm">Ver</a>
                                <a href="{{ route('direcciones.edit', $direccion) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
                                <form action="{{ route('direcciones.destroy', $direccion) }}" method="POST" onsubmit="return confirm('¿Eliminar esta dirección de tu libreta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-body py-5 px-4">
                        <i class="fas fa-location-dot fa-2x text-muted mb-3" aria-hidden="true"></i>
                        <h2 class="h5">Todavía no tienes direcciones guardadas</h2>
                        <p class="text-muted mb-0">Agrega tu primera dirección para utilizarla en tus próximas compras.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if ($direcciones->hasPages())
        <nav class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-4" aria-label="Páginas de direcciones">
            @if ($direcciones->onFirstPage())
                <span class="btn btn-outline-secondary disabled">Anterior</span>
            @else
                <a class="btn btn-outline-secondary" href="{{ $direcciones->previousPageUrl() }}">Anterior</a>
            @endif
            <span>Página {{ $direcciones->currentPage() }} de {{ $direcciones->lastPage() }}</span>
            @if ($direcciones->hasMorePages())
                <a class="btn btn-outline-secondary" href="{{ $direcciones->nextPageUrl() }}">Siguiente</a>
            @else
                <span class="btn btn-outline-secondary disabled">Siguiente</span>
            @endif
        </nav>
    @endif
</div>
@endsection
