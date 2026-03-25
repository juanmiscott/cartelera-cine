@props(['title' => 'Admin'])

<x-layouts.public title="Cartelera">


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
</x-layouts.public>