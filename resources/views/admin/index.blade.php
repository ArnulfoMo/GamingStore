@extends('layouts.admin')

@section('titulo', 'Panel Administrativo')
@section('page-title', 'Resumen general')

@section('page-actions')
    <span class="admin-date"><i class="bi bi-calendar3" aria-hidden="true"></i> {{ now()->format('d / m / Y') }}</span>
@endsection

@section('contenido')
    <section class="admin-welcome" aria-labelledby="bienvenida-titulo">
        <div class="admin-welcome-content">
            <span class="admin-pill"><span></span> Tu centro de administración</span>
            <h2 id="bienvenida-titulo">Tu tienda.<br><span>El siguiente nivel.</span></h2>
            <p>Bienvenido{{ auth()->check() ? ', ' . auth()->user()->name : '' }}. Organiza tu catálogo y gestiona la operación de Gaming Store desde un solo lugar.</p>
            <a href="{{ route('inicio') }}" class="btn btn-primary"><i class="bi bi-shop me-2" aria-hidden="true"></i>Ir a la tienda <i class="bi bi-arrow-up-right ms-2" aria-hidden="true"></i></a>
        </div>
        <div class="admin-welcome-art" aria-hidden="true"><div class="admin-orbit"></div><i class="bi bi-controller"></i><span>GAMING STORE</span></div>
    </section>

    <div class="admin-section-heading">
        <div><h2>Gestión de la tienda</h2><p>Todo lo que necesitas para tu operación diaria.</p></div>
        <span class="admin-section-label">Módulos</span>
    </div>

    <div class="row g-3 mb-4">

    </div>

    <section class="admin-workspace-note" aria-labelledby="espacio-titulo">
        <span class="admin-note-icon"><i class="bi bi-layout-sidebar-inset" aria-hidden="true"></i></span>
        <div><h2 id="espacio-titulo">Un espacio para cada tarea</h2><p>Encuentra los módulos en el menú lateral. Los que muestran un candado estarán disponibles cuando se habiliten.</p></div>
        <span class="admin-note-tag">Administración</span>
    </section>
@endsection
