<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function rules(): array
{
    return [
        'locale'             => 'required|array',
        'locale.es.title'    => 'required|string|max:255',
        'locale.es.description' => 'required|string',
        'locale.en.title'    => 'nullable|string|max:255',
        'locale.en.description' => 'nullable|string',
    ];
}

public function messages(): array
{
    return [
        'locale.es.title.required'       => 'El título en español es obligatorio.',
        'locale.es.description.required' => 'La descripción en español es obligatoria.',
    ];
}
}