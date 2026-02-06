<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PowerRequest extends FormRequest
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
            'hero_id' => 'required|integer',
            'power.name' => 'required|string',
            'power.level' => 'required|integer',
            'power.url' => 'nullable|string',


           // 'planet.name' => 'required|string',
            //'planet.color' => 'required|string',
            //'planet.description' => 'required|string',
        ];
    }
}
