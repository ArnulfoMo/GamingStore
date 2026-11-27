<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DireccionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'departamento' => 'required|string|max:100',
            'ciudad' => 'required|string|max:100',
            'colonia' => 'nullable|string|max:120',
            'calle' => 'nullable|string|max:255',
            'referencia' => 'nullable|string|max:255',
            'principal' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'departamento.required' => 'Escribe el departamento.',
            'ciudad.required' => 'Escribe la ciudad o municipio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no puede superar los :max caracteres.',
            'principal.boolean' => 'La opción de dirección principal no es válida.',
        ];
    }
}
