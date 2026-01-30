<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'color' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'hero_id' => 'nullable|integer',
            'power_id' => 'nullable|integer',
            'image_url' => 'nullable|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del planeta es obligatorio',
            'color.required' => 'El color del planeta es obligatorio',
            'image_url.url' => 'La imagen debe ser una URL válida'
        ];
    }
}
