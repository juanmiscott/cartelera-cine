<x-crud title="Preguntas Frecuentes"
  :indexUrl="route('faqs')"
  :storeUrl="route('faqs_store')"
  :deleteUrl="route('faqs_destroy', '__ID__')"
  :createUrl="route('faqs_create')"
>
  <x-slot name="table">
    <x-tables.faq-admin-table :records="$records" />
  </x-slot>

  <x-slot name="form">
    <x-forms.faq-admin-form :record="$record" />
  </x-slot>
</x-crud>