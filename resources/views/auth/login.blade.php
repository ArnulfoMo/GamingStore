@extends('auth.layout')

@section('auth-content')
<h1 class="h4 mb-1">Bienvenido de nuevo</h1>
<p class="text-muted small mb-4">Ingresa tus datos para acceder a tu cuenta.</p>

<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="email">Correo electrónico</label>
        <div class="input-icon">
            <i class="fas fa-envelope" aria-hidden="true"></i>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="tu@correo.com" autocomplete="username" maxlength="255" required autofocus>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Contraseña</label>
        <div class="input-icon">
            <i class="fas fa-lock" aria-hidden="true"></i>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Ingresa tu contraseña" autocomplete="current-password" required>
            <button class="toggle-pass" type="button" data-target="password" aria-label="Mostrar contraseña" aria-pressed="false"><i class="fas fa-eye" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="mb-4">
        <label class="filter-check mb-0" for="remember">
            <input type="checkbox" id="remember" name="remember" value="1" @checked(old('remember'))>
            <span>Recordarme</span>
        </label>
    </div>
    <button type="submit" class="btn btn-brand btn-lg w-100"><i class="fas fa-right-to-bracket me-2" aria-hidden="true"></i>Iniciar sesión</button>
</form>
@endsection
