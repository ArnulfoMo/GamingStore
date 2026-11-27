<div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
    <h2 class="h5 mb-0">Plataformas</h2>
    <span class="text-secondary">{{ $plataformas->total() }} registros</span>
</div>
<div class="table-responsive">
    <table class="table table-hover align-middle text-nowrap">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($plataformas as $plataforma)
                <tr>
                    <td>{{ $plataforma->id }}</td>
                    <td class="text-break">{{ $plataforma->nombre }}</td>
                    <td class="text-truncate" style="max-width:260px">{{ $plataforma->descripcion ?: 'Sin descripción' }}</td>
                    <td><span class="badge {{ $plataforma->activo ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $plataforma->activo ? 'Activo' : 'Inactivo' }}</span></td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.plataformas.show', $plataforma) }}" class="btn btn-outline-light btn-sm" data-catalogo-modal data-titulo="Detalle de plataforma">Ver</a>
                            <a href="{{ route('admin.plataformas.edit', $plataforma) }}" class="btn btn-outline-light btn-sm" data-catalogo-modal data-titulo="Editar plataforma">Editar</a>
                            <form action="{{ route('admin.plataformas.destroy', $plataforma) }}" method="POST" data-catalogo-form onsubmit="return confirm('¿Eliminar este registro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4">No hay registros.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@include('admin.partials.paginacion-catalogos', ['registros' => $plataformas])
