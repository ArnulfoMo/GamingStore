@php
    $menu = [
        ['route' => 'admin.index', 'label' => 'Resumen general', 'icon' => 'bi-grid-1x2'],
        ['route' => 'admin.usuarios.index', 'label' => 'Usuarios y roles', 'icon' => 'bi-people'],
        ['route' => 'admin.productos.index', 'label' => 'Productos', 'icon' => 'bi-box-seam'],
        ['route' => 'admin.videojuegos.index', 'label' => 'Videojuegos', 'icon' => 'bi-controller'],
        ['route' => 'admin.categorias.index', 'label' => 'Categorías', 'icon' => 'bi-tags'],
        ['route' => 'admin.plataformas.index', 'label' => 'Plataformas', 'icon' => 'bi-display'],
        ['route' => 'admin.inventario.index', 'label' => 'Inventario', 'icon' => 'bi-boxes'],
        ['route' => 'admin.claves-digitales.index', 'label' => 'Claves digitales', 'icon' => 'bi-key'],
        ['route' => 'admin.compras.index', 'label' => 'Compras', 'icon' => 'bi-bag'],
        ['route' => 'admin.ventas.index', 'label' => 'Ventas', 'icon' => 'bi-cart-check'],
        ['route' => 'admin.envios.index', 'label' => 'Envíos', 'icon' => 'bi-truck'],
        ['route' => 'admin.promociones.index', 'label' => 'Promociones', 'icon' => 'bi-percent'],
        ['route' => 'admin.facturas.index', 'label' => 'Facturas', 'icon' => 'bi-receipt'],
        ['route' => 'admin.reportes.index', 'label' => 'Reportes', 'icon' => 'bi-bar-chart'],
    ];
@endphp

<aside class="left-sidebar-pro" aria-label="Menú administrativo">
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('inicio') }}">
                <img class="main-logo" src="{{ asset('admin-assets/img/logo/logo.svg') }}" alt="Gaming Store">
            </a>
            <strong><img src="{{ asset('admin-assets/img/logo/favicon.svg') }}" width="36" height="36" alt="Gaming Store"></strong>
        </div>
        <div class="nalika-profile">
            <div class="profile-dtl">
                <div class="admin-profile-avatar" aria-hidden="true"><i class="bi bi-person"></i></div>
                @auth
                    <div class="small text-white min-dtn">Conectado como:</div>
                    <h2 class="min-dtn">{{ auth()->user()->name }}</h2>
                @else
                    <h2 class="min-dtn">Sin sesión iniciada</h2>
                @endauth
            </div>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <div class="admin-menu-label mini-click-non">Espacio de trabajo</div>
            <nav class="sidebar-nav left-sidebar-menu-pro" aria-label="Módulos">
                <ul class="metismenu" id="menu1">
                    @foreach ($menu as $item)
                        <li class="{{ request()->routeIs($item['route'] === 'admin.index' ? 'admin.index' : str_replace('.index', '.*', $item['route'])) ? 'active' : '' }}">
                            @if (Route::has($item['route']))
                                <a href="{{ route($item['route']) }}" title="{{ $item['label'] }}" @if(request()->routeIs($item['route'] === 'admin.index' ? 'admin.index' : str_replace('.index', '.*', $item['route']))) aria-current="page" @endif>
                                    <i class="bi big-icon {{ $item['icon'] }} icon-wrap" aria-hidden="true"></i>
                                    <span class="mini-click-non">{{ $item['label'] }}</span>
                                </a>
                            @else
                                <span class="admin-menu-disabled" aria-disabled="true" title="{{ $item['label'] }}: módulo pendiente de implementar">
                                    <i class="bi {{ $item['icon'] }} icon-wrap" aria-hidden="true"></i>
                                    <span class="mini-click-non">{{ $item['label'] }}</span>
                                    <i class="bi bi-lock admin-menu-lock mini-click-non" aria-hidden="true"></i>
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </nav>
</aside>
