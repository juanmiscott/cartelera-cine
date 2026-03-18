<x-crud title="Películas"
  :indexUrl="route('movies')"
  :storeUrl="route('movies_store')"
  :deleteUrl="route('movies_destroy', '__ID__')"
  :createUrl="route('movies_create')"
>
  <x-slot name="table">
    <x-tables.movie-admin-table :records="$records" />
  </x-slot>

  <x-slot name="form">
    <x-forms.movie-admin-form :record="$record" />
  </x-slot>
</x-crud>
