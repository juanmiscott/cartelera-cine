<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilmCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->input('id');

        return [
            'name' => 'required|string|max:255|unique:film_categories,name,' . ($id ?? 'NULL'),
        ];
    }
}