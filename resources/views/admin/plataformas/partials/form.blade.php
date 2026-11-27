<div class="alert alert-danger d-none" data-catalogo-errores role="alert"></div>

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
    <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $plataforma->nombre) }}" maxlength="100" required>
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3">{{ old('descripcion', $plataforma->descripcion) }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="logo" class="form-label">Logo (ruta o URL)</label>
    <input type="text" id="logo" name="logo" class="form-control @error('logo') is-invalid @enderror" value="{{ old('logo', $plataforma->logo) }}" maxlength="255">
    @error('logo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="activo" class="form-label">Estado <span class="text-danger">*</span></label>
    <select id="activo" name="activo" class="form-select @error('activo') is-invalid @enderror" required>
        <option value="1" @selected(old('activo', $plataforma->activo ?? 1) == 1)>Activo</option>
        <option value="0" @selected(old('activo', $plataforma->activo ?? 1) == 0)>Inactivo</option>
    </select>
    @error('activo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.plataformas.index') }}" class="btn btn-outline-light" data-catalogo-cerrar>Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
