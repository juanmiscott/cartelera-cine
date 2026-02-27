<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="movie-detail-page">

    <!-- Header -->
    <div class="cartelera-header">
        <a href="{{ route('home') }}" class="back-link">← Cartelera</a>
        <div class="cartelera-header__breadcrumb">
            <a href="{{ route('home') }}" class="breadcrumb-link">INICIO</a>
            <span class="breadcrumb-sep">/</span>
            <a href="{{ route('home') }}" class="breadcrumb-link">CARTELERA</a>
            <span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-active">{{ strtoupper($movie->title) }}</span>
        </div>
    </div>


    
    <!-- Contenido principal -->
    <div class="movie-detail">

        <!-- Póster -->
        <div class="movie-detail__poster-col">
            <div class="movie-detail__poster-wrap">
                <img
                    src="{{ $movie->image ? asset('storage/' . $movie->image) : 'https://cdng.europosters.eu/pod_public/1300/266365.jpg' }}"
                    alt="{{ $movie->title }}"
                    class="movie-detail__poster"
                />
                @if(\Carbon\Carbon::parse($movie->release_date)->gt(now()->subMonths(1)))
                    <div class="movie-card__badge">ESTRENO</div>
                @endif
            </div>
        </div>

        <!-- Info -->
        <div class="movie-detail__info-col">

            <h1 class="movie-detail__title">{{ $movie->title }}</h1>

            <div class="movie-detail__meta">
                <span class="meta-tag">{{ $movie->film_category }}</span>
                <span class="meta-sep">/</span>
                <span>{{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }}</span>
                <span class="meta-sep">/</span>
                <span>{{ $movie->duration }} minutos</span>
            </div>

            <!-- Tabs -->
            <div class="movie-tabs">
                <button class="movie-tab active" data-tab="pases">Pases</button>
                <button class="movie-tab" data-tab="sinopsis">Sinopsis</button>
            </div>

            <!-- Tab Pases -->
            <div class="movie-tab-content active" id="tab-pases">
                <div class="pases-section">
                    <div class="pases-header">
                        <span class="pases-label">Sesiones para:</span>
                        <span class="pases-date">
                            {{ \Carbon\Carbon::parse($movie->date_time)->locale('es')->isoFormat('dddd D [de] MMMM') }}
                        </span>
                    </div>
                    <div class="pases-horarios">
                        <div class="pases-horarios__label">Digital</div>
                        <div class="pases-horarios__times">
                            <span class="horario-pill">
                                {{ \Carbon\Carbon::parse($movie->date_time)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Sinopsis -->
            <div class="movie-tab-content" id="tab-sinopsis">
                <p class="movie-detail__description">{{ $movie->description }}</p>
            </div>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.movie-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.movie-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.movie-tab-content').forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
        });
    });
</script>

</body>
</html>