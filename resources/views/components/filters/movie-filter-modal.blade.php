<div class="filter-modal overlay" id="filterModal">
    <div class="modal modal--filter">

    <div class="modal__header">
        <div class="modal__header__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 12V19.88C12.04 20.18 11.94 20.5 11.71 20.71C11.32 21.1 10.69 21.1 10.3 20.71L8.29 18.7C8.06 18.47 7.96 18.16 8 17.87V12H7.97L2.21 4.62C1.87 4.19 1.95 3.56 2.38 3.22C2.57 3.08 2.78 3 3 3H17C17.22 3 17.43 3.08 17.62 3.22C18.05 3.56 18.13 4.19 17.79 4.62L12.03 12H12" />
            </svg>
        </div>
        <h3 class="modal__title">Filtrar películas</h3>
        <button class="modal__close" id="userFilterModalClose" aria-label="Cerrar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>

    </div>

    <form class="modal__form" novalidate>

        <div class="form__group">
            <label class="form__label" for="filter_title">Titulo</label>
            <input type="text" id="filter_title" name="title" class="form__input" placeholder="Buscar por titulo" value="{{ request('title') }}" autocomplete="off">
        </div>

        <div class="form__group">
            <label class="form__label" for="filter_category">Categoria</label>
            <div class="form__select-wrapper">
                <select id="filter_category" name="film_category" class="form__select">
                    <option value="">Todas las categorias</option>
                    <option value="accion"     {{ request('film_category') === 'accion'     ? 'selected' : '' }}>Accion</option>
                    <option value="comedia"    {{ request('film_category') === 'comedia'    ? 'selected' : '' }}>Comedia</option>
                    <option value="drama"      {{ request('film_category') === 'drama'      ? 'selected' : '' }}>Drama</option>
                    <option value="terror"     {{ request('film_category') === 'terror'     ? 'selected' : '' }}>Terror</option>
                    <option value="romance"    {{ request('film_category') === 'romance'    ? 'selected' : '' }}>Romance</option>
                    <option value="animacion"  {{ request('film_category') === 'animacion'  ? 'selected' : '' }}>Animacion</option>
                    <option value="documental" {{ request('film_category') === 'documental' ? 'selected' : '' }}>Documental</option>
                    <option value="ciencia_ficcion" {{ request('film_category') === 'ciencia_ficcion' ? 'selected' : '' }}>Ciencia ficción</option>
                </select>
                <svg class="form__select-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
        </div>

        <div class="form__group">
            <label class="form__label">Duración (minutos)   </label>
            <input type="number" name="duration" class="form__input" placeholder="Ej: 120" min="0" value="{{ request('duration') }}">
        </div>

        <div class="form__group">
            <label class="form__label">Fecha de estreno</label>
            <input type="date" name="release_date" class="form__input" value="{{ request('release_date') }}">
        </div>

        <div class="form__group">
            <label class="form__label">Fecha de funcion</label>
            <div class="form__range-row">
                <input type="date" name="showtime_from" class="form__input form__input--half" value="{{ request('showtime_from') }}">
                <span class="form__range-sep">—</span>
                <input type="date" name="showtime_to" class="form__input form__input--half" value="{{ request('showtime_to') }}">
            </div>
        </div>

    </form>

    <div class="modal__actions">
        <button type="button" class="filter-cancel-button">Limpiar</button>
        <button type="button" class="filter-apply-button">Aplicar filtros</button>
    </div>

    </div>
</div>