<div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
    <h2 class="h5 mb-0">Categorías</h2>
    <span class="text-secondary">{{ $categorias->total() }} registros</span>
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
            @forelse ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td class="text-break">{{ $categoria->nombre }}</td>
                    <td class="text-truncate" style="max-width:260px">{{ $categoria->descripcion ?: 'Sin descripción' }}</td>
                    <td><span class="badge {{ $categoria->activo ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $categoria->activo ? 'Activo' : 'Inactivo' }}</span></td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.categorias.show', $categoria) }}" class="btn btn-outline-light btn-sm" data-catalogo-modal data-titulo="Detalle de categoría">Ver</a>
                            <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn btn-outline-light btn-sm" data-catalogo-modal data-titulo="Editar categoría">Editar</a>
                            <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" data-catalogo-form onsubmit="return confirm('¿Eliminar este registro?')">
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
@include('admin.partials.paginacion-catalogos', ['registros' => $categorias])
