<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="admin-panel">
        <div class="admin-panel__header">
            <div class="header__title">
                <h2>{{ __('admin/titles.users') }}</h2>
            </div>
        </div>
        
        <div class="admin-panel__content">

            <div class="admin-panel__table">
                <section class="table">
                    <div class="table__header">
                        <div class="table__header__box">
                            <button class="filter-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <title>filtro</title>
                                    <path d="M12 12V19.88C12.04 20.18 11.94 20.5 11.71 20.71C11.32 21.1 10.69 21.1 10.3 20.71L8.29 18.7C8.06 18.47 7.96 18.16 8 17.87V12H7.97L2.21 4.62C1.87 4.19 1.95 3.56 2.38 3.22C2.57 3.08 2.78 3 3 3H17C17.22 3 17.43 3.08 17.62 3.22C18.05 3.56 18.13 4.19 17.79 4.62L12.03 12H12M17.75 21L15 18L16.16 16.84L17.75 18.43L21.34 14.84L22.5 16.25L17.75 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                   <div class="table__body">
                        @foreach($records as $record)
                            <div class="table-row">
                                <div class="table-row__content">
                                    <p><strong>Nombre:</strong> {{ $record->name }}</p>
                                    <p><strong>Email:</strong> {{ $record->email }}</p>
                                    <p><strong>Creado:</strong> {{ $record->created_at->format('d/m/Y') }}</p>
                                    <p><strong>Actualizado:</strong> {{ $record->updated_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="table__footer">
                        <div class="table__footer-box">
                            <div class="table-page-info">{{ $records->total() }} registros en total, mostrando {{ $records->perPage() }} por página</div>
                            <div class="table-page-controls">
                                <button class="table-page-button first-page disabled" data-page="1" title="doble izquierda">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>chevron-double-left</title>
                                        <path d="M18.41,7.41L17,6L11,12L17,18L18.41,16.59L13.83,12L18.41,7.41M12.41,7.41L11,6L5,12L11,18L12.41,16.59L7.83,12L12.41,7.41Z" />
                                    </svg>
                                </button>

                                <button class="table-page-button prev-page disabled" data-page="1" title="izquierda">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>chevron-left</title>
                                        <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
                                    </svg>
                                </button>

                                <button class="table-page-button next-page disabled" data-page="1" title="derecha">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>chevron-right</title>
                                        <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                                    </svg>
                                </button>

                                <button class="table-page-button last-page disabled" data-page="1" title="doble derecha">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>chevron-double-right</title>
                                        <path d="M5.59,7.41L7,6L13,12L7,18L5.59,16.59L10.17,12L5.59,7.41M11.59,7.41L13,6L19,12L13,18L11.59,16.59L16.17,12L11.59,7.41Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="admin-panel__form">
                <section class="form">
                    <div class="form__header">
                        <div class="form__header-box">
                            <div class="tabs">
                                <div class="tab active" data-tab="general">
                                    <button>General</button>
                                </div>
                                <div class="tab" data-tab="images">
                                    <button>Imagenes</button>
                                </div>
                            </div>
                            <div class="form__header-icons">
                                <button class="clean-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>eraser</title>
                                        <path d="M16.24,3.56L21.19,8.5C21.97,9.29 21.97,10.55 21.19,11.34L12,20.53C10.44,22.09 7.91,22.09 6.34,20.53L2.81,17C2.03,16.21 2.03,14.95 2.81,14.16L13.41,3.56C14.2,2.78 15.46,2.78 16.24,3.56M4.22,15.58L7.76,19.11C8.54,19.9 9.8,19.9 10.59,19.11L14.12,15.58L9.17,10.63L4.22,15.58Z" />
                                    </svg>
                                </button>
                                <button class="save-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>content-save</title>
                                        <path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form__body">
                        <div class="validation-errors">
                            <ul></ul>
                        </div>
                        <form>
                            <div class="tab-content active" data-tab="general">
                                <input type="hidden" name="id">
                                <div class="form-element">
                                    <div class="form-title">
                                        <span>Nombre</span>
                                    </div>
                                    <div class="form-element-input">
                                        <input type="text" placeholder="" name="name">
                                    </div>
                                </div>
                                <div class="form-element">
                                    <div class="form-title">
                                        <span>Email</span>
                                    </div>
                                    <div class="form-element-input">
                                        <input type="email" placeholder="" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" data-tab="images">
                                <div class="form-element">
                                    <div class="form-title">
                                        <span>Imagen</span>
                                    </div>
                                    <div class="form-element-input">
                                        <input type="text" placeholder="" name="image">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            

        </div>
        
        <!-- Modal de filtros -->
        <div class="overlay" id="filterModal">
            <div class="modal">
                <h3 class="title">Filtrar tabla</h3>
                <div class="filter-form">
                    <form id="filterForm">
                        <div class="form-element">
                            <div class="form-title">
                                <span>Nombre</span>
                            </div>
                            <div class="form-element-input">
                                <input type="text" placeholder="" name="name">
                            </div>
                        </div>
                        <div class="form-element">
                            <div class="form-title">
                                <span>Email</span>
                            </div>
                            <div class="form-element-input">
                                <input type="email" placeholder="" name="email">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="filter-buttons">
                    <button class="cancel-button">Cancelar</button>
                    <button class="apply-button">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>