<header class="header-advance-area">
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="nk-header-bar">
                <button type="button" id="sidebarCollapse" class="btn text-white p-0 me-3 border-0" aria-label="Mostrar u ocultar menú" aria-controls="sidebar">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                        <path d="M3 5h18M3 12h18M3 19h18" />
                    </svg>
                </button>
                <span class="admin-header-label">Panel de control <span>{{ request()->routeIs('operador.*') ? 'Operación de la tienda' : 'Gestión de la tienda' }}</span></span>
                <div class="nk-header-right ms-auto">
                    <a href="{{ route('inicio') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-shop me-1" aria-hidden="true"></i> Ver tienda
                    </a>
                    <div class="dropdown">
                        <button type="button" id="usuarioAdmin" class="btn border-0 nk-header-icon nk-header-user" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Opciones de sesión">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="7" r="4" />
                                <path d="M4 21v-2a8 8 0 0 1 16 0v2Z" />
                            </svg>
                            <span class="nk-user-name">{{ auth()->user()?->name ?? 'Sesión' }}</span>
                            <i class="bi bi-chevron-down" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end nk-user-menu shadow" aria-labelledby="usuarioAdmin">
                            @auth
                                <li><span class="dropdown-item-text fw-bold">{{ auth()->user()->name }}</span></li>
                                <li><span class="dropdown-item-text small">{{ auth()->user()->email }}</span></li>
                                @if (Route::has('logout'))
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-1" aria-hidden="true"></i>Cerrar sesión
                                            </button>
                                        </form>
                                    </li>
                                @endif
                            @else
                                <li><span class="dropdown-item-text small">Sin sesión iniciada</span></li>
                                @if (Route::has('login'))
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar sesión</a></li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
