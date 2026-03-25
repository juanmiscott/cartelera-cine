@props(['record', 'type', 'language' => 'es'])

@php
    $files = $record->adminImages[$language][$type]['files'] ?? [];
@endphp

@foreach($files as $file)
    <div class="upload-image">
        <img src="{{ route('images_thumb', ['filename' => $file['filename']]) }}" 
             alt="{{ $file['alt'] ?? '' }}" 
             title="{{ $file['title'] ?? '' }}">
        <button type="button" class="delete-image-button">×</button>
    </div>
@endforeach