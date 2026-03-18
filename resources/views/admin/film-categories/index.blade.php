<x-crud title="Categorias"
  :indexUrl="route('film_categories')"
  :storeUrl="route('film_categories_store')"
  :deleteUrl="route('film_categories_destroy', '__ID__')"
  :createUrl="route('film_categories_create')"
>
  <x-slot name="table">
    <x-tables.film-category-admin-table :records="$records" />
  </x-slot>

  <x-slot name="form">
    <x-forms.film-category-admin-form :record="$record" />
  </x-slot>
</x-crud>
