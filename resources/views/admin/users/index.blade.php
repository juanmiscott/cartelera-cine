<x-crud title="{{ __('admin/titles.users') }}"
    :storeUrl="route('users_store')"
    :updateUrl="route('users_update', '__ID__')"
    :deleteUrl="route('users_destroy', '__ID__')"
>  <x-slot name="table">
    <x-admin-table :tableStructure="$tableStructure" :records="$records" />
  </x-slot>

  <x-slot name="form">
    <x-admin-form :formStructure="$formStructure" :record="$record" />
  </x-slot>
</x-crud>
