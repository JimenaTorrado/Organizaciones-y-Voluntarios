<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">

    <style>
        :root {
            --verde: #16a34a;
            --verde-oscuro: #15803d;
            --verde-claro: #dcfce7;
            --azul: #1d4ed8;
            --azul-oscuro: #1e40af;
            --azul-claro: #dbeafe;
            --texto: #1f2937;
            --texto-suave: #6b7280;
            --borde: #e5e7eb;
            --fondo: #f5f7fa;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Nunito', sans-serif;
            color: var(--texto);
            background: var(--fondo);
        }

        a { color: inherit; text-decoration: none; }

        /* ---------- Barra superior ---------- */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 10px 40px;
            background: linear-gradient(90deg, var(--verde-oscuro), var(--azul));
            color: #fff;
        }

        .brand { display: flex; align-items: center; gap: 10px; }

        .brand-icon {
            display: grid;
            place-items: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #fff;
            color: var(--verde-oscuro);
        }

        .brand-name { font-weight: 800; font-size: 15px; line-height: 1.1; }
        .brand-sub { font-size: 11px; opacity: .85; }

        .topbar-links { display: flex; align-items: center; gap: 22px; font-weight: 700; font-size: 14px; }
        .topbar-links a:hover { opacity: .85; }

        .btn-top {
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            border: 1px solid #fff;
        }

        .btn-top.solido { background: #fff; color: var(--azul); }

        /* ---------- Tarjeta central ---------- */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        .card {
            width: 100%;
            max-width: 535px;
            padding: 36px 40px 28px;
            background: #fff;
            border-radius: 22px;
            border-top: 4px solid var(--verde);
            box-shadow: 0 10px 35px rgba(30, 64, 175, .12);
            text-align: center;
        }

        .card-head { display: flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 14px; }

        .icon-circle {
            display: grid;
            place-items: center;
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--azul-claro);
            color: var(--verde-oscuro);
            font-size: 30px;
        }

        .badge {
            padding: 3px 12px;
            border-radius: 999px;
            background: var(--verde-claro);
            color: var(--verde-oscuro);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .card h1 { margin: 0 0 10px; font-size: 26px; font-weight: 600; }
        .card .lead { margin: 0 0 22px; color: var(--texto-suave); font-size: 13px; line-height: 1.6; }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0;
            color: var(--texto-suave);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: var(--borde); }

        /* ---------- Botones ---------- */
        .actions { display: flex; gap: 8px; }

        .btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid transparent;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background .15s, color .15s;
        }

        .btn-verde { background: var(--verde); color: #fff; }
        .btn-verde:hover { background: var(--verde-oscuro); }

        .btn-azul { background: #fff; color: var(--azul); border-color: var(--azul); }
        .btn-azul:hover { background: var(--azul); color: #fff; }

        .btn-block { width: 100%; }

        /* ---------- Formularios ---------- */
        .form { text-align: left; }
        .field { margin-bottom: 14px; }
        .field label { display: block; margin-bottom: 5px; font-size: 13px; font-weight: 700; }

        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid var(--borde);
            border-radius: 10px;
            overflow: hidden;
        }

        .input-group:focus-within { border-color: var(--azul); box-shadow: 0 0 0 3px var(--azul-claro); }
        .input-group i { padding: 0 12px; color: var(--texto-suave); font-size: 14px; }

        .input-group input {
            flex: 1;
            min-width: 0;
            padding: 10px 12px 10px 0;
            border: 0;
            outline: 0;
            font-family: inherit;
            font-size: 14px;
        }

        .field.invalid .input-group { border-color: #dc2626; }
        .error { display: block; margin-top: 4px; color: #dc2626; font-size: 12px; }

        .row-between { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: 13px; }
        .row-between label { display: flex; align-items: center; gap: 6px; }

        .link { color: var(--azul); font-weight: 700; }
        .link:hover { text-decoration: underline; }

        .card-foot {
            margin-top: 22px;
            padding-top: 16px;
            border-top: 1px solid var(--borde);
            color: var(--texto-suave);
            font-size: 12px;
        }

        .card-foot .link { color: var(--verde-oscuro); }

        @media (max-width: 640px) {
            .topbar { padding: 10px 16px; }
            .topbar-links .ocultable { display: none; }
            .card { padding: 28px 20px 22px; }
            .actions { flex-direction: column; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <a href="{{ url('/') }}" class="brand">
            <span class="brand-icon"><i class="fas fa-hands-helping"></i></span>
            <span>
                <span class="brand-name">{{ config('app.name') }}</span><br>
                <span class="brand-sub">Gestión de voluntariado</span>
            </span>
        </a>

        <nav class="topbar-links">
            <a href="{{ url('/') }}" class="ocultable">Inicio</a>
            @auth
                <a href="{{ route('home') }}" class="btn-top solido">Ir al panel</a>
            @else
                <a href="{{ route('login') }}" class="btn-top">Ingresa</a>
                <a href="{{ route('register') }}" class="btn-top solido">Regístrate</a>
            @endauth
        </nav>
    </header>

    <main>
        <div class="card">
            <div class="card-head">
                <span class="icon-circle"><i class="fas @yield('icon', 'fa-hands-helping')"></i></span>
                <span class="badge">Gestión de voluntariado</span>
            </div>

            @yield('content')

            <div class="card-foot">
                ¿Necesitas ayuda con tu cuenta? <a href="#" class="link">Contáctanos</a>
            </div>
        </div>
    </main>
</body>
</html>
