@props(['movie'])

<div class="cartelera-header">
    <a href="{{ route(App::getLocale() . '.movie', $movie->locale[App::getLocale()]['title']) }}" class="back-link">← Cartelera</a>
    <div class="cartelera-header__breadcrumb">
        <a href="{{ route(App::getLocale() . '.home') }}" class="breadcrumb-link">INICIO</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-active">{{ strtoupper($movie->locale[App::getLocale()]['title']) }}</span>
    </div>
</div>