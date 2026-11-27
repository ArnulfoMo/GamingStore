@if ($registros->hasPages())
    <nav class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3" aria-label="Páginas del catálogo" data-catalogo-paginacion>
        @if ($registros->onFirstPage())
            <span class="btn btn-outline-secondary disabled">Anterior</span>
        @else
            <a href="{{ $registros->previousPageUrl() }}" class="btn btn-outline-light">Anterior</a>
        @endif
        <span>Página {{ $registros->currentPage() }} de {{ $registros->lastPage() }}</span>
        @if ($registros->hasMorePages())
            <a href="{{ $registros->nextPageUrl() }}" class="btn btn-outline-light">Siguiente</a>
        @else
            <span class="btn btn-outline-secondary disabled">Siguiente</span>
        @endif
    </nav>
@endif
