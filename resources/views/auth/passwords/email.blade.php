@extends('layouts.guest')

@section('title', 'Recuperar contraseña')
@section('icon', 'fa-key')

@section('content')
    <h1>Recuperar contraseña</h1>
    <p class="lead">Escribe el correo de tu cuenta y te enviaremos un enlace para crear una contraseña nueva.</p>

    @if (session('status'))
        <div class="alert-ok" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="form">
        @csrf

        <div class="field @error('email') invalid @enderror">
            <label for="email">Correo electrónico</label>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       placeholder="tucorreo@ejemplo.com" required autocomplete="email" autofocus>
            </div>
            @error('email')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-verde btn-block">
            <i class="fas fa-paper-plane"></i> Enviar enlace
        </button>
    </form>

    <div class="divider">¿Ya la recordaste?</div>

    <div class="actions">
        <a href="{{ route('login') }}" class="btn btn-azul">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </a>
    </div>
@endsection
