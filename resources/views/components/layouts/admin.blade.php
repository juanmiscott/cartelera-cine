@props(['title' => 'Admin'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family: Montserrat, sans-serif;">

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar" id="sidebar">
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
    </aside>

    <main style="flex:1;">
        {{ $slot }}
    </main>

    <x-delete-modal/>
    @include('components.image-modal')
</body>
</html>