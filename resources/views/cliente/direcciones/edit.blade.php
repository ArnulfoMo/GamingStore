@extends('layouts.cliente')

@section('title', 'Editar dirección — Gaming Store')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="h3 mb-1">Editar dirección</h1>
            <p class="text-muted mb-4">Actualiza los datos de tu dirección de entrega.</p>
            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('direcciones.update', $direccion) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('cliente.direcciones.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
