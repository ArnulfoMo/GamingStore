@extends('layouts.cliente')

@section('title', 'Inicio - GamingStore')

@section('body-class', 'gaming-home')

@section('content')

    <section class="client-welcome container py-5">

        <h1>Bienvenido a GamingStore</h1>

        <p>
            Descubre los mejores videojuegos,
            consolas y accesorios gaming.
        </p>

        <a href="#" class="btn btn-primary">
            Explorar catálogo
        </a>

    </section>

@endsection

@push('scripts')
    <script src="{{ asset('cliente-assets/js/home.js') }}"></script>
    <script src="{{ asset('cliente-assets/js/gaming.js') }}"></script>
@endpush
