@extends('layouts.guest')

@section('title', 'Registrarse')
@section('icon', 'fa-user-plus')

@section('content')
    <h1>Crear cuenta</h1>
    <p class="lead">Regístrate para empezar a gestionar organizaciones y voluntarios.</p>

    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf

        <div class="field @error('name') invalid @enderror">
            <label for="name">Nombre</label>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       placeholder="Tu nombre completo" required autocomplete="name" autofocus>
            </div>
            @error('name')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="field @error('email') invalid @enderror">
            <label for="email">Correo electrónico</label>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       placeholder="tucorreo@ejemplo.com" required autocomplete="email">
            </div>
            @error('email')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="field @error('password') invalid @enderror">
            <label for="password">Contraseña</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" name="password"
                       placeholder="Mínimo 8 caracteres" required autocomplete="new-password">
            </div>
            @error('password')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="password-confirm">Confirmar contraseña</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input id="password-confirm" type="password" name="password_confirmation"
                       placeholder="Repite la contraseña" required autocomplete="new-password">
            </div>
        </div>

        <button type="submit" class="btn btn-verde btn-block">
            <i class="fas fa-user-plus"></i> Registrarse
        </button>
    </form>

    <div class="divider">¿Ya tienes cuenta?</div>

    <div class="actions">
        <a href="{{ route('login') }}" class="btn btn-azul">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </a>
    </div>
@endsection
