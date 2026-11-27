@extends('auth.layout')

@section('auth-content')
<h1 class="h4 mb-1">Crea tu cuenta</h1>
<p class="text-muted small mb-4">Únete a Gaming Store y prepárate para tu próxima partida.</p>

<form method="POST" action="{{ route('register.post') }}" data-register-form data-availability-url="{{ route('register.disponibilidad') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="name">Nombre completo</label>
        <div class="input-icon">
            <i class="fas fa-user" aria-hidden="true"></i>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Tu nombre completo" autocomplete="name" maxlength="150" required autofocus>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="gamertag">Gamertag</label>
        <div class="input-icon">
            <i class="fas fa-gamepad" aria-hidden="true"></i>
            <input type="text" class="form-control @error('gamertag') is-invalid @enderror" id="gamertag" name="gamertag" value="{{ old('gamertag') }}" placeholder="Tu nombre de jugador" autocomplete="nickname" maxlength="50" aria-describedby="gamertag-status" @error('gamertag') aria-invalid="true" @enderror data-availability-field="gamertag" required>
        </div>
        <small id="gamertag-status" class="d-block mt-1 @error('gamertag') text-danger @else text-muted @enderror" role="status" aria-live="polite">{{ $errors->first('gamertag') ?: 'Elige un gamertag de hasta 50 caracteres.' }}</small>
    </div>
    <div class="mb-3">
        <label class="form-label" for="email">Correo electrónico</label>
        <div class="input-icon">
            <i class="fas fa-envelope" aria-hidden="true"></i>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="tu@correo.com" autocomplete="email" maxlength="254" aria-describedby="email-status" @error('email') aria-invalid="true" @enderror data-availability-field="email" required>
        </div>
        <small id="email-status" class="d-block mt-1 @error('email') text-danger @else text-muted @enderror" role="status" aria-live="polite">{{ $errors->first('email') }}</small>
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Contraseña</label>
        <div class="input-icon">
            <i class="fas fa-lock" aria-hidden="true"></i>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Crea tu contraseña" autocomplete="new-password" minlength="8" aria-describedby="password-help" required>
            <button class="toggle-pass" type="button" data-target="password" aria-label="Mostrar contraseña" aria-pressed="false"><i class="fas fa-eye" aria-hidden="true"></i></button>
        </div>
        <small class="text-muted" id="password-help">Usa al menos 8 caracteres.</small>
    </div>
    <div class="mb-4">
        <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
        <div class="input-icon">
            <i class="fas fa-lock" aria-hidden="true"></i>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" autocomplete="new-password" minlength="8" required>
            <button class="toggle-pass" type="button" data-target="password_confirmation" aria-label="Mostrar contraseña" aria-pressed="false"><i class="fas fa-eye" aria-hidden="true"></i></button>
        </div>
    </div>
    <button type="submit" class="btn btn-accent btn-lg w-100"><i class="fas fa-user-plus me-2" aria-hidden="true"></i>Crear cuenta</button>
</form>
@endsection

@push('scripts')
<script src="{{ asset('cliente-assets/js/register.js') }}"></script>
@endpush
