@extends('layouts.cliente')

@section('title', request()->routeIs('register') ? 'Crear cuenta — Gaming Store' : 'Iniciar sesión — Gaming Store')

@section('content')
<div class="container auth-wrap">
    <div class="row justify-content-center w-100 mx-0">
        <div class="col-lg-10">
            <div class="auth-card">
                <div class="row g-0">
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="auth-aside">
                            <span class="hero-pill mb-3"><i class="fas fa-gamepad" aria-hidden="true"></i> Gaming Store</span>
                            <h2 class="h3">Tu próxima partida comienza aquí</h2>
                            <p>Inicia sesión o crea tu cuenta para ser parte de nuestra comunidad gamer.</p>
                            <ul>
                                <li><i class="fas fa-circle-check" aria-hidden="true"></i>Videojuegos para tus plataformas favoritas</li>
                                <li><i class="fas fa-circle-check" aria-hidden="true"></i>Consolas y accesorios para tu setup</li>
                                <li><i class="fas fa-circle-check" aria-hidden="true"></i>Todo lo que necesitas para jugar</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-4 p-md-5">
                            <nav class="nav nav-tabs mb-4" aria-label="Acceso a tu cuenta">
                                <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}" @if(request()->routeIs('login')) aria-current="page" @endif>Iniciar sesión</a>
                                <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}" @if(request()->routeIs('register')) aria-current="page" @endif>Crear cuenta</a>
                            </nav>
                            @if (session('success'))
                                <div class="alert alert-success" role="status">{{ session('success') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @yield('auth-content')
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center mt-4 mb-0">
                <a href="{{ route('inicio') }}" class="btn btn-ghost"><i class="fas fa-arrow-left me-2" aria-hidden="true"></i>Volver a la tienda</a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('cliente-assets/js/auth.js') }}"></script>
@endpush
