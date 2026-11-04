@extends('layouts.guest')

@section('title', 'Inicio')

@section('content')
    <h1>{{ config('app.name') }}</h1>
    <p class="lead">
        Registra organizaciones, inscribe voluntarios y lleva el control de quién participa en cada una.
    </p>

    <div class="divider">Ingresa a tu cuenta</div>

    <div class="actions">
        @auth
            <a href="{{ route('home') }}" class="btn btn-verde">
                <i class="fas fa-tachometer-alt"></i> Ir al panel
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-verde">
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="btn btn-azul">
                <i class="fas fa-user-plus"></i> Registrarse
            </a>
        @endauth
    </div>
@endsection
