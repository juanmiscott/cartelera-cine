<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <form method="GET" action="{{ route('login') }}">
                @csrf
                <button class="logout-button" type="submit">Login</button>
            </form>
        </div>
    </div>

    <div class="cartelera-grid">
        <a href="{{ route('movie', 1) }}" class="movie-card">
            <div class="movie-card">
                <div class="movie-card__badge">ESTRENO</div>
                <img src="https://cdng.europosters.eu/pod_public/1300/266365.jpg" alt="Pelicula 1" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 2) }}">
            <div class="movie-card">
                <div class="movie-card__badge">ESTRENO</div>
                <img src="https://es.web.img2.acsta.net/pictures/14/05/28/11/24/435900.jpg" alt="Pelicula 2" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 3) }}">
            <div class="movie-card">
                <div class="movie-card__badge">ESTRENO</div>
                <img src="https://play-lh.googleusercontent.com/KwzNgJyWxNq1MdbF7osx30Hcn4iUf245bW0a78mpZlYUwTn4yMZNuP9r_oAhxyd8zOHlXg=w240-h480-rw" alt="Pelicula 3" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 4) }}">
            <div class="movie-card">
                <div class="movie-card__badge">ESTRENO</div>
                <img src="https://m.media-amazon.com/images/M/MV5BMGVkMGUwZDctNTMwZS00YzIwLWIxY2UtOGZjZjY4ZGMxYzg0XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg" alt="Pelicula 4" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 5) }}">
            <div class="movie-card">
                <div class="movie-card__badge">ESTRENO</div>
                <img src="https://www.tuposter.com/pub/media/catalog/product/cache/71d04d62b2100522587d43c930e8a36b/m/e/medianoche_en_par_s_poster.png" alt="Pelicula 12" class="movie-card__img" alt="Pelicula 5" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 6) }}">
            <div class="movie-card">
                <div class="movie-card__badge">ESTRENO</div>
                <img src="https://m.media-amazon.com/images/M/MV5BYzM0MDI3MjQtZTc0MC00YzNlLWExYjUtNjFlOTg3NmI5ZWUyXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg" alt="Pelicula 6" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 7) }}">
            <div class="movie-card">
                <img src="https://preview.redd.it/new-f1-the-movie-poster-v0-afpqwbimoc0f1.jpeg?auto=webp&s=ab9894cd8f5b0d93f234c695c4ea45bbcf4b94a8" alt="Pelicula 7" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 8) }}">
            <div class="movie-card">
                <img src="https://www.nochedecine.com/wp-content/uploads/2013/09/nt_13_prisioneros.jpg" alt="Pelicula 8" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 9) }}">
            <div class="movie-card">
                <img src="https://static.posters.cz/image/1300/122134.jpg" alt="Pelicula 9" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 10) }}">
            <div class="movie-card">
                <img src="https://static.posters.cz/image/750/81805.jpg" alt="Pelicula 10" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 11) }}">
            <div class="movie-card">
                <img src="https://i.ebayimg.com/00/s/MTU5OVgxMDc2/z/SxcAAOSwUCdnEI0F/$_57.JPG?set_id=880000500F" alt="Pelicula 11" class="movie-card__img" />
            </div>
        </a>

        <a href="{{ route('movies.show', 12) }}">
            <div class="movie-card">
                <img src="https://image.tmdb.org/t/p/original/iLMtX4MGl8WjKCPfMgCdDuceOth.jpg" alt="Pelicula 12" class="movie-card__img" />
            </div>
        </a>

    </div>
</div>

</body>
</html>