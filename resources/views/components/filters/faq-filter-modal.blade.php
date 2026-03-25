<div class="filter-modal overlay" id="filterModal">
    <div class="modal modal--filter">

        <div class="modal__header">
            <div class="modal__header__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 12V19.88C12.04 20.18 11.94 20.5 11.71 20.71C11.32 21.1 10.69 21.1 10.3 20.71L8.29 18.7C8.06 18.47 7.96 18.16 8 17.87V12H7.97L2.21 4.62C1.87 4.19 1.95 3.56 2.38 3.22C2.57 3.08 2.78 3 3 3H17C17.22 3 17.43 3.08 17.62 3.22C18.05 3.56 18.13 4.19 17.79 4.62L12.03 12H12" />
                </svg>
            </div>
            <h3 class="modal__title">Filtrar Preguntas Frecuentes</h3>
            <button class="modal__close" id="faqFilterModalClose" aria-label="Cerrar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form class="modal__form" novalidate>
            <div class="form__group">
                <label class="form__label" for="filter_title">Título</label>
                <input type="text" id="filter_title" name="title" class="form__input" placeholder="Buscar por título" value="{{ request('title') }}" autocomplete="off">
            </div>
        </form>

        <div class="modal__actions">
            <button type="button" class="filter-cancel-button">Limpiar</button>
            <button type="button" class="filter-apply-button">Aplicar filtros</button>
        </div>

    </div>
</div>