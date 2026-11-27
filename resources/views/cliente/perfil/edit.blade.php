@extends('layouts.cliente')

@section('title', 'Mi perfil — Gaming Store')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="h3 mb-1">Mi perfil</h1>
                    <p class="text-muted mb-0">Actualiza tus datos personales y tu información de contacto.</p>
                </div>
                <a href="{{ route($usuario->homeRoute()) }}" class="btn btn-outline-secondary">Volver al inicio</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <p class="fw-bold mb-1">Revisa los siguientes datos:</p>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h5 mb-4">Datos personales</h2>
                    <form action="{{ route('perfil.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nombre completo <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $usuario->name) }}" autocomplete="name" maxlength="150" @error('name') aria-invalid="true" aria-describedby="name-error" @enderror required>
                                @error('name')
                                    <div id="name-error" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gamertag" class="form-label">Gamertag <span class="text-danger">*</span></label>
                                <input type="text" id="gamertag" name="gamertag" class="form-control @error('gamertag') is-invalid @enderror" value="{{ old('gamertag', $usuario->gamertag) }}" autocomplete="nickname" maxlength="50" @error('gamertag') aria-invalid="true" aria-describedby="gamertag-error" @enderror required>
                                @error('gamertag')
                                    <div id="gamertag-error" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $usuario->email) }}" autocomplete="email" maxlength="254" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror required>
                                @error('email')
                                    <div id="email-error" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $usuario->telefono) }}" autocomplete="tel" maxlength="20" placeholder="Ej: +504 9999-9999" @error('telefono') aria-invalid="true" aria-describedby="telefono-error" @enderror>
                                @error('telefono')
                                    <div id="telefono-error" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento?->format('Y-m-d')) }}" autocomplete="bday" max="{{ now('America/Tegucigalpa')->toDateString() }}" @error('fecha_nacimiento') aria-invalid="true" aria-describedby="fecha_nacimiento-error" @enderror>
                                @error('fecha_nacimiento')
                                    <div id="fecha_nacimiento-error" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <p class="small text-muted">Los campos con <span class="text-danger">*</span> son obligatorios.</p>
                        <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                            <a href="{{ route($usuario->homeRoute()) }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-brand"><i class="fas fa-save me-1" aria-hidden="true"></i>Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
