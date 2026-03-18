@props(['title', 'indexUrl', 'storeUrl', 'deleteUrl', 'createUrl'])

<x-layouts.admin :title="$title">

<div class="admin-panel"
    data-index-url="{{ $indexUrl }}"
    data-store-url="{{ $storeUrl }}"
    data-delete-url="{{ $deleteUrl }}"
    data-create-url="{{ $createUrl }}">

    <div class="admin-panel__header">
    <div class="header__title">
        <h2>{{ $title }}</h2>
    </div>

    <div class="header__actions">
        <form method="GET" action="{{ route('logout') }}">
            @csrf
            <button class="logout-button" type="submit">Log-out</button>
        </form>

        <button class="menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <title>menu</title>
                <path d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
            </svg>
        </button>
    </div>
</div>

    <div class="admin-panel__content">

        <div class="admin-panel__table">
            {{ $table }}
        </div>

        <div class="admin-panel__form">
            {{ $form }}
        </div>
     
    </div>

</div>

</x-layouts.admin>
