<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
      if ($this->has('images') && is_string($this->images)) {
        $this->merge([
          'images' => json_decode($this->images, true),
        ]);
      }
    }


    public function rules()
    {
        return [
            'film_category' => 'required',
            'duration'      => 'required',
            'release_date'  => 'required',
            'date_time'     => 'required',
            'locale.es.title' => 'required',
            'locale.es.description' => 'string',
            'locale.en.title' => 'required',
            'locale.en.description' => 'string',
            'images' => 'nullable|array',
            'images.*.title' => 'nullable|string',
            'images.*.alt' => 'nullable|string',
            'images.*.filename' => 'nullable|string',   
        ];
    }

    public function messages()
    {
        return [
            'film_category.required' => 'La categoría es obligatoria',
            'film_category.min'      => 'El mínimo de caracteres para la categoría son 2',
            'film_category.max'      => 'El máximo de caracteres para la categoría son 255',
            'duration.required'      => 'La duración es obligatoria',
            'release_date.required'  => 'La fecha de estreno es obligatoria',
            'release_date.date'      => 'El formato de la fecha de estreno es incorrecto',
            'date_time.required'     => 'La fecha y hora de función es obligatoria',
            'date_time.date'         => 'El formato de la fecha y hora es incorrecto',
            'locale.es.title.required' => 'El título es obligatorio',
            'locale.es.description.string' => 'La descripción debe ser un string',
            'locale.en.title.required' => 'El título es obligatorio',
            'locale.en.description.string' => 'La descripción debe ser un string'
        ];
    }
}