@php
    $images = \App\Models\MongoDB\Image::all();
@endphp

@foreach ($images as $image)
    <div class="image-modal__gallery-item" data-filename="{{ $image->filename }}">
        <img src="{{ route('images_thumb', ['filename' => $image->filename]) }}" alt="Imagen">
        
        <button type="button" class="btn-delete-image" 
                data-endpoint="{{ route('images_destroy', ['filename' => $image->filename]) }}"
                title="Eliminar esta imagen">
            <svg viewBox="0 0 24 24">
                <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19V4M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
            </svg>
        </button>
    </div>
@endforeach

@if($images->isEmpty())
    <p class="image-modal__gallery-empty">No hay imagenes en la galeria.</p>
@endif