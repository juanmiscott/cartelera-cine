<x-crud title="{{ __('admin/titles.users') }}"
  :indexUrl="route('users')"
  :storeUrl="route('users_store')"
  :deleteUrl="route('users_destroy', '__ID__')"
  :createUrl="route('users_create')"
>  
  <x-slot name="table">
    <x-tables.user-admin-table :records="$records" />
  </x-slot>

  <x-slot name="form">
    <x-forms.user-admin-form :record="$record" />
  </x-slot>
</x-crud>
