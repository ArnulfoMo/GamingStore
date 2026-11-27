@extends('layouts.cliente')

@section('title', 'Detalle de dirección — Gaming Store')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="h3 mb-4">Detalle de dirección</h1>
            <div class="card">
                <div class="card-body p-4">
                    @if ($direccion->pivot->principal)
                        <span class="badge text-bg-success mb-3">Dirección principal</span>
                    @endif
                    <dl class="row text-break">
                        <dt class="col-sm-4">Departamento</dt>
                        <dd class="col-sm-8">{{ $direccion->departamento }}</dd>
                        <dt class="col-sm-4">Ciudad o municipio</dt>
                        <dd class="col-sm-8">{{ $direccion->ciudad }}</dd>
                        <dt class="col-sm-4">Colonia o barrio</dt>
                        <dd class="col-sm-8">{{ $direccion->colonia ?: 'Sin especificar' }}</dd>
                        <dt class="col-sm-4">Calle y número de casa</dt>
                        <dd class="col-sm-8">{{ $direccion->calle ?: 'Sin especificar' }}</dd>
                        <dt class="col-sm-4">Referencias</dt>
                        <dd class="col-sm-8">{{ $direccion->referencia ?: 'Sin especificar' }}</dd>
                    </dl>
                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                        <a href="{{ route('direcciones.index') }}" class="btn btn-outline-secondary">Volver a mis direcciones</a>
                        <a href="{{ route('direcciones.edit', $direccion) }}" class="btn btn-brand">Editar dirección</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
