
<!DOCTYPE html>
<html lang="es" data-theme="dark" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#18181b">
    <meta name="description" content="Gaming Store — Tu tienda de videojuegos, consolas y accesorios gaming.">

    <title>@yield('title', 'Gaming Store')</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('cliente/images/favicon.svg') }}">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap y Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('cliente/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('cliente/css/gaming.css') }}?v={{ filemtime(public_path('cliente/css/gaming.css')) }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="gaming-home">

<div class="scroll-progress" aria-hidden="true"></div>

<!-- Navbar -->
<header class="site-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('cliente/images/logo.svg') }}" alt="Gaming Store">
            </a>

            <div class="d-flex align-items-center gap-1 order-lg-3">
                <div class="header-actions">

                    <a class="icon-btn" href="#" aria-label="Lista de deseos" title="Lista de deseos">
                        <i class="far fa-heart"></i>
                        <span class="icon-badge js-wishlist-count" data-count="0">0</span>
                    </a>

                    <a class="icon-btn" href="#" aria-label="Carrito de compras" title="Carrito">
                        <i class="fas fa-cart-shopping"></i>
                        <span class="icon-badge js-cart-count" data-count="0">0</span>
                    </a>

                    <a class="icon-btn d-none d-sm-inline-flex" href="#" aria-label="Mi cuenta" title="Mi cuenta">
                        <i class="far fa-user"></i>
                    </a>

                </div>

                <button class="navbar-toggler ms-1"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#mainNav"
                        aria-controls="mainNav"
                        aria-expanded="false"
                        aria-label="Abrir navegación">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse order-lg-2" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="#">
                            Inicio
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('categorias*') ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown">
                            Categorías
                        </a>
                        <ul class="dropdown-menu js-category-menu"></ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('productos*') ? 'active' : '' }}" href="#">
                            Productos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('nosotros') ? 'active' : '' }}" href="#">
                            Nosotros
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contacto') ? 'active' : '' }}" href="#">
                            Contacto
                        </a>
                    </li>
                </ul>

                <form class="header-search me-lg-3" role="search">
                    <input type="search"
                           placeholder="Buscar videojuegos, consolas, accesorios…"
                           aria-label="Buscar productos"
                           autocomplete="off">

                    <button type="submit" aria-label="Buscar">
                        <i class="fas fa-magnifying-glass"></i>
                    </button>

                    <div class="search-suggestions"></div>
                </form>
            </div>

        </div>
    </nav>
</header>

<!-- Contenido -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('cliente/images/logo.svg') }}"
                     alt="Gaming Store"
                     style="height:48px"
                     class="mb-3">

                <p>
                    Gaming Store es tu tienda especializada en
                    videojuegos, consolas y accesorios gaming.
                    Encuentra tus productos favoritos, precios
                    competitivos y una experiencia de compra segura.
                </p>

                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h6>Comprar</h6>
                <ul class="footer-links">
                    <li><a href="#">Videojuegos</a></li>
                    <li><a href="#">Consolas</a></li>
                    <li><a href="#">Accesorios</a></li>
                    <li><a href="#">Productos gaming</a></li>
                    <li><a href="#">Ofertas</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h6>Empresa</h6>
                <ul class="footer-links">
                    <li><a href="#">Sobre nosotros</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="#">Preguntas frecuentes</a></li>
                    <li><a href="#">Tu carrito</a></li>
                    <li><a href="#">Lista de deseos</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6>Contáctanos</h6>

                <ul class="footer-links footer-contact list-unstyled">
                    <li>
                        <i class="fas fa-location-dot"></i>
                        <span>Honduras</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>Teléfono de contacto</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>Correo de contacto</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Horario de atención por definir</span>
                    </li>
                </ul>

                <img src="{{ asset('cliente/images/payments.svg') }}"
                     alt="Métodos de pago aceptados"
                     style="max-width:300px;opacity:.9"
                     class="mt-2">
            </div>

        </div>

        <div class="footer-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>
                © <span data-year>2026</span>
                Gaming Store. Todos los derechos reservados.
            </span>

            <span class="d-flex gap-3">
                <a href="#">Política de privacidad</a>
                <a href="#">Términos y condiciones</a>
                <a href="#">Política de envíos</a>
            </span>
        </div>
    </div>
</footer>

<!-- Volver arriba -->
<button class="back-to-top" type="button" aria-label="Volver arriba">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('cliente/js/data.js') }}"></script>
<script src="{{ asset('cliente/js/main.js') }}"></script>
<script src="{{ asset('cliente/js/home.js') }}"></script>
<script src="{{ asset('cliente/js/gaming.js') }}"></script>

@stack('scripts')

</body>
</html>
