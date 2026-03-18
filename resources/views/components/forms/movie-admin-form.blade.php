@props(['formStructure', 'record'])

<section class="form">
  <div class="form__header">
    <div class="form__header-box">
      <div class="tabs tabs--main">

        <div class="tab active" data-tab="general">
          <button type="button">General</button>
        </div>

        <div class="tab" data-tab="imagenes">
          <button type="button">Imagenes</button>
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
        <input type="hidden" name="id" value="{{ $record->id }}">

        <div class="form-element">
          <div class="form-title"><span>Categoría</span></div>
          <div class="form-element-input">
            <select id="filter_category" name="film_category" class="form__select">
              <option value="">Todas las categorias</option>
              @foreach ($filmCategories as $filmCategory)
                <option value="{{ $filmCategory->name }}" {{ $record->film_category === $filmCategory->name ? 'selected' : '' }}>{{ $filmCategory->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-element">
          <div class="form-title"><span>Duración</span></div>
          <div class="form-element-input">
            <input type="text" name="duration" value="{{ $record->duration }}">
          </div>
        </div>

        <div class="form-element">
          <div class="form-title"><span>Fecha de estreno</span></div>
          <div class="form-element-input">
            <input type="date" name="release_date" value="{{ $record->release_date?->format('Y-m-d') }}">
          </div>
        </div>

        <div class="form-element">
          <div class="form-title"><span>Fecha y hora</span></div>
          <div class="form-element-input">
            <input type="datetime-local" name="date_time" value="{{ $record->date_time?->format('Y-m-d\TH:i') }}">
          </div>
        </div>


        <div class="tabs tabs--lang">
          @foreach ($languages as $language)
            <div class="tab-lang {{ $loop->first ? 'active' : '' }}" data-lang="{{ $language->label }}">
              <button type="button">{{ $language->label }}</button>
            </div>
          @endforeach
        </div>

        @foreach ($languages as $language)
          <div class="tab-lang-content {{ $loop->first ? 'active' : '' }}" data-lang="{{ $language->label }}">
            <div class="form-element">
              <div class="form-title"><span>Titulo</span></div>
              <div class="form-element-input">
                <input type="text" name="locale[{{ $language->label }}][title]" value="{{ $record->locale[$language->label]['title'] ?? '' }}">
              </div>
            </div>
            <div class="form-element">
              <div class="form-title"><span>Descripción</span></div>
              <div class="form-element-input">
                <textarea name="locale[{{ $language->label }}][description]">{{ $record->locale[$language->label]['description'] ?? '' }}</textarea>
              </div>
            </div>
          </div>
        @endforeach
      </div>


      <div class="tab-content" data-tab="imagenes">
        <div class="form-element" style="display: flex; justify-content: center; padding: 40px 0;">
          <div class="form-element-input">
            <button type="button" class="image-button image-button--large">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" />
              </svg>
              <span>Subir Imagen</span>
            </button>
          </div>
        </div>
      </div>

    </form>
  </div>

</section>
