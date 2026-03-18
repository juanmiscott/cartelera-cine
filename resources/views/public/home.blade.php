<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cartelera</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="cartelera-page">
   
    <div class="cartelera-header">
        <h2 class="cartelera-header__title">Cartelera</h2>
        <div class="cartelera-header__breadcrumb">

            <x-language/>

            <form method="GET" action="{{ route('customer-login') }}">
                @csrf
                <button class="logout-button" type="submit">Login</button>
            </form>

            <button class="menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <title>menu</title>
                <path d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
            </svg>
        </button>

        <div class="sidebar" id="sidebar">
            <div class="sidebar__header">
                <span>Menu</span>
                <button class="sidebar__close" id="sidebarClose">&times;</button>
            </div>
            <nav class="sidebar__nav">
                <a href="{{ url('/') }}" class="sidebar__link">
                    Cartelera
                </a>
                <a href="{{ route('dashboard') }}" class="sidebar__link">
                    Dashboard
                </a>
                <a href="{{ route('users') }}" class="sidebar__link">
                    Panel Usuarios
                </a>
                <a href="{{ route('movies') }}" class="sidebar__link">
                    Panel Peliculas
                </a>
                <a href="{{ route('film_categories') }}" class="sidebar__link">
                    Panel Categorias
                </a>
            </nav>
        </div>
        </div>
    </div>

    <div class="cartelera-grid">
        @foreach ($movies as $movie)
            <a href="{{ route(App::getLocale() . '.movie', $movie->locale[App::getLocale()]['title']) }}" class="movie-card">
                <div class="movie-card">
                    <div class="movie-card__badge">ESTRENO</div>
                    <img src="https://cdng.europosters.eu/pod_public/1300/266365.jpg" alt="{{ $movie->title }}" class="movie-card__img" />
                </div>
            </a>
        @endforeach
    </div>
</div>

</body>
</html>

