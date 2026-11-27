@php
    $opcionesCuenta = [
        ['route' => 'perfil.edit', 'label' => 'Mi perfil', 'icon' => 'far fa-user'],
        ['route' => 'direcciones.index', 'label' => 'Mis direcciones', 'icon' => 'fas fa-location-dot'],
        ['route' => 'pedidos.index', 'label' => 'Mis pedidos', 'icon' => 'fas fa-box'],
        ['route' => 'licencias.index', 'label' => 'Mis juegos y licencias', 'icon' => 'fas fa-key'],
        ['route' => 'facturas.index', 'label' => 'Mis facturas', 'icon' => 'fas fa-receipt'],
    ];
@endphp

<div class="dropdown account-dropdown">
    <button type="button" id="cuenta-toggle" class="icon-btn account-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" aria-controls="cuenta-menu" aria-label="Abrir menú de mi cuenta" title="Mi cuenta">
        <i class="far fa-user" aria-hidden="true"></i>
    </button>
    <ul id="cuenta-menu" class="dropdown-menu dropdown-menu-end account-menu" aria-labelledby="cuenta-toggle">
        <li class="account-menu-header">
            <span class="account-menu-name">{{ $usuario->name }}</span>
            <span class="account-menu-caption">Tu espacio gamer</span>
        </li>
        <li><hr class="dropdown-divider"></li>
        @foreach ($opcionesCuenta as $opcion)
            <li>
                @if (Route::has($opcion['route']))
                    <a class="dropdown-item account-menu-item {{ request()->routeIs(str_replace('.index', '.*', $opcion['route'])) ? 'active' : '' }}" href="{{ route($opcion['route']) }}" @if (request()->routeIs(str_replace('.index', '.*', $opcion['route']))) aria-current="page" @endif>
                        <i class="{{ $opcion['icon'] }}" aria-hidden="true"></i>
                        <span>{{ $opcion['label'] }}</span>
                    </a>
                @else
                    <span class="dropdown-item account-menu-item disabled" aria-disabled="true" title="Próximamente">
                        <i class="{{ $opcion['icon'] }}" aria-hidden="true"></i>
                        <span>{{ $opcion['label'] }}</span>
                    </span>
                @endif
            </li>
        @endforeach
        @if ($usuario->isAdmin() || $usuario->hasRole('operador'))
            <li>
                <a class="dropdown-item account-menu-item" href="{{ route($usuario->homeRoute()) }}">
                    <i class="fas fa-gauge" aria-hidden="true"></i>
                    <span>Panel de gestión</span>
                </a>
            </li>
        @endif
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item account-menu-item">
                    <i class="fas fa-arrow-right-from-bracket" aria-hidden="true"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </li>
    </ul>
</div>
