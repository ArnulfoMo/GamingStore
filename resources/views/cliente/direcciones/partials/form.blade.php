<div class="row">
    <div class="col-md-6 mb-3">
        <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
        <input type="text" id="departamento" name="departamento" class="form-control @error('departamento') is-invalid @enderror" value="{{ old('departamento', $direccion->departamento) }}" maxlength="100" autocomplete="address-level1" placeholder="Ej: Francisco Morazán" required>
        @error('departamento')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="ciudad" class="form-label">Ciudad o municipio <span class="text-danger">*</span></label>
        <input type="text" id="ciudad" name="ciudad" class="form-control @error('ciudad') is-invalid @enderror" value="{{ old('ciudad', $direccion->ciudad) }}" maxlength="100" autocomplete="address-level2" placeholder="Ej: Tegucigalpa" required>
        @error('ciudad')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-3">
        <label for="colonia" class="form-label">Colonia o barrio</label>
        <input type="text" id="colonia" name="colonia" class="form-control @error('colonia') is-invalid @enderror" value="{{ old('colonia', $direccion->colonia) }}" maxlength="120" autocomplete="address-level3">
        @error('colonia')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-3">
        <label for="calle" class="form-label">Calle y número de casa</label>
        <input type="text" id="calle" name="calle" class="form-control @error('calle') is-invalid @enderror" value="{{ old('calle', $direccion->calle) }}" maxlength="255" autocomplete="address-line1">
        @error('calle')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-3">
        <label for="referencia" class="form-label">Referencias para la entrega</label>
        <textarea id="referencia" name="referencia" class="form-control @error('referencia') is-invalid @enderror" rows="3" maxlength="255" placeholder="Ej: Casa de esquina, frente al parque.">{{ old('referencia', $direccion->referencia) }}</textarea>
        @error('referencia')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@if ($direccion->pivot && $direccion->pivot->principal)
    <p class="text-muted small">Esta es tu dirección principal. Puedes elegir otra desde tu libreta.</p>
@else
    <div class="form-check mb-2">
        <input type="checkbox" id="principal" name="principal" value="1" class="form-check-input @error('principal') is-invalid @enderror" @checked(old('principal'))>
        <label for="principal" class="form-check-label">Usar como dirección principal</label>
    </div>
    @if (! $direccion->exists)
        <p class="text-muted small">Tu primera dirección se usará como principal automáticamente.</p>
    @endif
@endif
@error('principal')
    <p class="text-danger small" role="alert">{{ $message }}</p>
@enderror
<p class="text-muted small">Los campos con <span class="text-danger">*</span> son obligatorios.</p>

<div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
    <a href="{{ route('direcciones.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-brand"><i class="fas fa-save me-1" aria-hidden="true"></i>Guardar dirección</button>
</div>
