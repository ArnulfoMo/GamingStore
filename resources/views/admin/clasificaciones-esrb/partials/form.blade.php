<div class="alert alert-danger d-none" data-catalogo-errores role="alert"></div>

<div class="mb-3">
    <label for="codigo" class="form-label">Código <span class="text-danger">*</span></label>
    <input type="text" id="codigo" name="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo', $clasificacion->codigo) }}" maxlength="10" required>
    @error('codigo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
    <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $clasificacion->nombre) }}" maxlength="80" required>
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="edad_minima" class="form-label">Edad mínima <span class="text-danger">*</span></label>
    <input type="number" id="edad_minima" name="edad_minima" class="form-control @error('edad_minima') is-invalid @enderror" value="{{ old('edad_minima', $clasificacion->edad_minima) }}" min="0" max="127" step="1" required>
    @error('edad_minima')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3">{{ old('descripcion', $clasificacion->descripcion) }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.clasificaciones-esrb.index') }}" class="btn btn-outline-light" data-catalogo-cerrar>Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
