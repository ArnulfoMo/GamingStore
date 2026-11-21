@extends('layouts.admin')

@section('titulo', 'Panel de operador')
@section('page-title', 'Panel de operador')

@section('contenido')
<section class="admin-welcome" aria-labelledby="operador-titulo">
    <div class="admin-welcome-content">
        <span class="admin-pill"><span></span> Operación de la tienda</span>
        <h2 id="operador-titulo">Bienvenido, {{ auth()->user()->name }}</h2>
        <p>Este es tu espacio de trabajo para las tareas de soporte y almacén.</p>
        <a href="{{ route('inicio') }}" class="btn btn-primary"><i class="bi bi-shop me-2" aria-hidden="true"></i>Ver tienda</a>
    </div>
    <div class="admin-welcome-art" aria-hidden="true"><div class="admin-orbit"></div><i class="bi bi-box-seam"></i><span>GAMING STORE</span></div>
</section>
@endsection
