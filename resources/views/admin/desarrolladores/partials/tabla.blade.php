<div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
    <h2 class="h5 mb-0">Desarrolladores</h2>
    <span class="text-secondary">{{ $desarrolladores->total() }} registros</span>
</div>
<div class="table-responsive">
    <table class="table table-hover align-middle text-nowrap">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($desarrolladores as $desarrollador)
                <tr>
                    <td>{{ $desarrollador->id }}</td>
                    <td class="text-break">{{ $desarrollador->nombre }}</td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.desarrolladores.show', $desarrollador) }}" class="btn btn-outline-light btn-sm" data-catalogo-modal data-titulo="Detalle de desarrollador">Ver</a>
                            <a href="{{ route('admin.desarrolladores.edit', $desarrollador) }}" class="btn btn-outline-light btn-sm" data-catalogo-modal data-titulo="Editar desarrollador">Editar</a>
                            <form action="{{ route('admin.desarrolladores.destroy', $desarrollador) }}" method="POST" data-catalogo-form onsubmit="return confirm('¿Eliminar este registro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center py-4">No hay registros.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@include('admin.partials.paginacion-catalogos', ['registros' => $desarrolladores])
