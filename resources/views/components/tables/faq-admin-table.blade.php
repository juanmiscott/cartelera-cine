@props(['tableStructure', 'records'])

<section class="table">

    <x-filters.faq-filter-modal />

    <div class="table__header">
        <div class="table__header__box">
        </div>
    </div>


    <div class="table__body">
        @foreach($records as $record)
            <div class="table-row">

                <div class="element-box__upper-row">
                    <button class="edit-button"
                            data-endpoint="{{ route('faqs_edit', $record->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <title>pencil</title>
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                    </button>

                    <button class="delete-button" data-id="{{ $record->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <title>delete</title>
                            <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                        </svg>
                    </button>
                </div>

                <div class="table-row__content">
                    <p><strong>Título:</strong> {{ $record->locale['es']['title'] ?? '-' }}</p>
                    <p><strong>Descripción:</strong> {{ Str::limit($record->locale['es']['description'] ?? '-', 100) }}</p>
                </div>

            </div>
        @endforeach
    </div>

    <x-table-pagination :records="$records" />

</section>