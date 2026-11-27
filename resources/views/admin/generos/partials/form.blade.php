<div class="alert alert-danger d-none" data-catalogo-errores role="alert"></div>

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
    <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $genero->nombre) }}" maxlength="100" required>
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.generos.index') }}" class="btn btn-outline-light" data-catalogo-cerrar>Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
