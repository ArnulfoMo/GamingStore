<div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
    <h2 class="h5 mb-0">Clasificaciones ESRB</h2>
    <span class="text-secondary">{{ $clasificaciones_esrb->total() }} registros</span>
</div>
<div class="table-responsive">
    <table class="table table-hover align-middle text-nowrap">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Edad mínima</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clasificaciones_esrb as $clasificacion)
                <tr>
                    <td>{{ $clasificacion->id }}</td>
                    <td class="text-break">{{ $clasificacion->codigo }}</td>
                    <td class="text-break">{{ $clasificacion->nombre }}</td>
                    <td class="text-break">{{ $clasificacion->edad_minima }}</td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.clasificaciones-esrb.show', $clasificacion) }}" class="btn btn-outline-light btn-sm" data-catalogo-modal data-titulo="Detalle de clasificación ESRB">Ver</a>
                            <a href="{{ route('admin.clasificaciones-esrb.edit', $clasificacion) }}" class="btn btn-outline-light btn-sm" data-catalogo-modal data-titulo="Editar clasificación ESRB">Editar</a>
                            <form action="{{ route('admin.clasificaciones-esrb.destroy', $clasificacion) }}" method="POST" data-catalogo-form onsubmit="return confirm('¿Eliminar este registro?')">
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
@include('admin.partials.paginacion-catalogos', ['registros' => $clasificaciones_esrb])
