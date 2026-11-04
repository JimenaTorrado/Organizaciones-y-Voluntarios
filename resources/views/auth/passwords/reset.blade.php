@extends('layouts.guest')

@section('title', 'Nueva contraseña')
@section('icon', 'fa-key')

@section('content')
    <h1>Nueva contraseña</h1>
    <p class="lead">Escribe tu correo y la contraseña nueva que quieres usar.</p>

    <form method="POST" action="{{ route('password.update') }}" class="form">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="field @error('email') invalid @enderror">
            <label for="email">Correo electrónico</label>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                       placeholder="tucorreo@ejemplo.com" required autocomplete="email" autofocus>
            </div>
            @error('email')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="field @error('password') invalid @enderror">
            <label for="password">Contraseña nueva</label>
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
            <i class="fas fa-save"></i> Guardar contraseña
        </button>
    </form>

    <div class="divider">¿Ya la recordaste?</div>

    <div class="actions">
        <a href="{{ route('login') }}" class="btn btn-azul">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </a>
    </div>
@endsection
