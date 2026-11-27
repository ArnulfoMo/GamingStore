@extends('layouts.admin')

@section('titulo', 'Usuarios y roles')
@section('page-title', 'Usuarios y roles')

@section('contenido')
<div class="card border mb-4">
    <div class="card-body">
        <h2 class="h5">Permisos de acceso</h2>
        <p class="text-secondary mb-2">Los registros públicos crean clientes. Asigna el rol de operador al personal de soporte y almacén, o administrador a quienes gestionan la tienda y sus permisos.</p>
        <p class="text-secondary mb-0">Las cuentas desactivadas no pueden iniciar sesión ni acceder a las áreas privadas. Por seguridad, no puedes desactivar tu propia cuenta ni quitarte el rol de administrador.</p>
    </div>
</div>

<div id="user-status" class="alert d-none" role="status" aria-live="polite"></div>

<div class="card border">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
            <h2 class="h5 mb-0">Cuentas registradas</h2>
            <span class="text-secondary">{{ $usuarios->total() }} usuarios</span>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <caption class="visually-hidden">Usuarios registrados y asignación de roles</caption>
                <thead><tr><th scope="col">Usuario</th><th scope="col">Correo</th><th scope="col">Rol actual</th><th scope="col">Asignar rol</th><th scope="col">Estado</th><th scope="col">Acceso</th></tr></thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        @php
                            $rolActual = $usuario->roles->firstWhere('nombre', 'administrador')
                                ?? $usuario->roles->firstWhere('nombre', 'operador')
                                ?? $usuario->roles->firstWhere('nombre', 'cliente');
                        @endphp
                        <tr>
                            <td>{{ $usuario->name }} @if ($usuario->is(auth()->user()))<span class="badge text-bg-secondary">Tú</span>@endif</td>
                            <td>{{ $usuario->email }}</td>
                            <td data-current-role>{{ $usuario->roles->pluck('nombre')->map(fn ($nombre) => ucfirst($nombre))->join(', ') ?: 'Sin rol' }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.usuarios.update', $usuario) }}" class="d-flex flex-wrap gap-2" data-role-form>
                                    @csrf
                                    @method('PATCH')
                                    <label for="rol-{{ $usuario->id }}" class="visually-hidden">Rol de {{ $usuario->name }}</label>
                                    <select name="role_id" id="rol-{{ $usuario->id }}" class="form-select form-select-sm w-auto" required>
                                        <option value="" disabled @selected(! $rolActual)>Seleccionar rol</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @selected($rolActual?->id === $role->id) @disabled($usuario->is(auth()->user()) && $role->nombre !== 'administrador')>{{ ucfirst($role->nombre) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm" aria-label="Guardar rol de {{ $usuario->name }}">Guardar</button>
                                </form>
                            </td>
                            <td><span class="badge {{ $usuario->activo ? 'text-bg-success' : 'text-bg-secondary' }}" data-current-status>{{ $usuario->activo ? 'Activa' : 'Desactivada' }}</span></td>
                            <td>
                                <form method="POST" action="{{ route('admin.usuarios.estado', $usuario) }}" data-status-form data-user-name="{{ $usuario->name }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="activo" value="{{ $usuario->activo ? '0' : '1' }}">
                                    <button type="submit" class="btn btn-sm {{ $usuario->activo ? 'btn-outline-danger' : 'btn-outline-success' }}" aria-label="{{ $usuario->activo ? 'Desactivar' : 'Activar' }} cuenta de {{ $usuario->name }}" @disabled($usuario->is(auth()->user())) @if ($usuario->is(auth()->user())) title="No puedes desactivar tu propia cuenta." @endif>{{ $usuario->activo ? 'Desactivar' : 'Activar' }}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4">No hay usuarios registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($usuarios->hasPages())
            <nav class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-3" aria-label="Páginas de usuarios">
                @if ($usuarios->onFirstPage())
                    <span class="btn btn-outline-secondary disabled">Anterior</span>
                @else
                    <a class="btn btn-outline-light" href="{{ $usuarios->previousPageUrl() }}">Anterior</a>
                @endif
                <span>Página {{ $usuarios->currentPage() }} de {{ $usuarios->lastPage() }}</span>
                @if ($usuarios->hasMorePages())
                    <a class="btn btn-outline-light" href="{{ $usuarios->nextPageUrl() }}">Siguiente</a>
                @else
                    <span class="btn btn-outline-secondary disabled">Siguiente</span>
                @endif
            </nav>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin-assets/js/usuarios.js') }}"></script>
@endpush
