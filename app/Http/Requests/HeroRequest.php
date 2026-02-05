<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
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
            'hero.name' => 'required|string|max:255',
            'hero.age' => 'required|integer',
            'hero.color' => 'required|string|max:100',
            'hero.gender' => 'required|string|max:50',
            'hero.url' => 'nullable|string|max:255',

            'power.name' => 'required|string|max:255',
            'power.level' => 'required|integer',
            'power.url' => 'nullable|string|max:255',
            
            'planet.name' => 'required|string|max:255',
            'planet.color' => 'required|string|max:100',
            'planet.description' => 'required|string',
            'planet.url' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'age.required' => 'The age field is required.',
            'color.required' => 'The color field is required.',
            'gender.required' => 'The gender field is required.',
        ];
    }
}
