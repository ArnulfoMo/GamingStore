<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#10121d">
    <title>@yield('titulo', 'Panel Administrativo') - Gaming Store</title>

    <link rel="icon" href="{{ asset('admin/img/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/nalika-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/gaming-admin.css') }}?v={{ filemtime(public_path('admin/css/gaming-admin.css')) }}">
    @stack('styles')
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="all-content-wrapper">
        @include('admin.partials.header')

        <main id="contenido-admin" class="container-fluid py-4">
            <div class="admin-page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <div class="admin-eyebrow mb-2">Gaming Store / Administración</div>
                    <h1 class="h3 text-white mb-0">@yield('page-title', 'Administración')</h1>
                </div>
                @yield('page-actions')
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="status">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <p class="fw-bold mb-2">Revisa los siguientes datos:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('contenido')
        </main>

        <footer class="footer-copyright-area mt-4">
            <div class="container-fluid">
                <div class="footer-copy-right">
                    <p>© {{ date('Y') }} Gaming Store. Plantilla Nalika de <a href="https://colorlib.com/wp/templates/">Colorlib</a>.</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/js/main.js') }}?v={{ filemtime(public_path('admin/js/main.js')) }}"></script>
    @stack('scripts')
</body>
</html>
