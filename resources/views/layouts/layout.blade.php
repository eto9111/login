<!DOCTYPE html>
<html>
<head>
    <title>Kuroko no Basket</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @stack('styles')
</head>
<body>

<nav>
    <a href="/">Inicio</a>
    <a href="/menu">Personajes</a>
    <a href="/nosotros">Anime</a>
    <a href="/capitulos">Temporadas y Películas</a>
    <a href="{{ route('comunidad.index') }}">Comunidad</a>
    <a href="{{ route('tienda') }}" style="color: #ffcc00; font-weight: bold; text-shadow: 0 0 5px rgba(255, 204, 0, 0.5);">Tienda Oficial</a>

    <div class="auth-links">
        @guest
            <a href="{{ route('login') }}">Iniciar Sesión</a>
            <a href="{{ route('register') }}">Registrarse</a>
        @endguest
        @auth
            <a href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    Cerrar Sesión
                </a>
            </form>
        @endauth
    </div>
</nav>

<hr>

@yield('content')

</body>
</html>
