<x-crud title="Películas"
    :storeUrl="route('movies_store')"
    :updateUrl="route('movies_update', '__ID__')"
    :deleteUrl="route('movies_destroy', '__ID__')"
>
  <x-slot name="table">
    <x-admin-table :tableStructure="$tableStructure" :records="$records" />
  </x-slot>

  <x-slot name="form">
    <x-admin-form :formStructure="$formStructure" :record="$record" />
  </x-slot>
</x-crud>
