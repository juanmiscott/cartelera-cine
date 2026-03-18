@props(['tableStructure', 'records'])

<section class="table">

    <x-filters.user-filter-modal />

    <div class="table__header">
        <div class="table__header__box">
            <button class="filter-button" data-filter="users">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <title>filtro</title>
                    <path d="M12 12V19.88C12.04 20.18 11.94 20.5 11.71 20.71C11.32 21.1 10.69 21.1 10.3 20.71L8.29 18.7C8.06 18.47 7.96 18.16 8 17.87V12H7.97L2.21 4.62C1.87 4.19 1.95 3.56 2.38 3.22C2.57 3.08 2.78 3 3 3H17C17.22 3 17.43 3.08 17.62 3.22C18.05 3.56 18.13 4.19 17.79 4.62L12.03 12H12" />
                </svg>
            </button>
        </div>
    </div>

    <div class="table__body">
        @foreach($records as $record)
            <div class="table-row">

                <div class="element-box__upper-row">
                    <button class="edit-button"
                            data-endpoint="{{ route('users_edit', $record->id) }}">
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
                  <p><strong>Nombre:</strong> {{ $record->name }}</p>
                  <p><strong>Email:</strong> {{ $record->email }}</p>
                </div>

            </div>
        @endforeach
    </div>

    <x-table-pagination :records="$records" />

</section>
