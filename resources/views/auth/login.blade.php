@extends('layouts.guest')

@section('title', 'Iniciar Sesión')
@section('icon', 'fa-sign-in-alt')

@section('content')
    <h1>Iniciar Sesión</h1>
    <p class="lead">Ingresa con tu correo y contraseña para administrar organizaciones y voluntarios.</p>

    <form method="POST" action="{{ route('login') }}" class="form">
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

        <div class="field @error('password') invalid @enderror">
            <label for="password">Contraseña</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" name="password"
                       placeholder="••••••••" required autocomplete="current-password">
            </div>
            @error('password')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="row-between">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link">¿Olvidaste tu contraseña?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-verde btn-block">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </button>
    </form>

    <div class="divider">¿No tienes cuenta?</div>

    <div class="actions">
        <a href="{{ route('register') }}" class="btn btn-azul">
            <i class="fas fa-user-plus"></i> Registrarse
        </a>
    </div>
@endsection
