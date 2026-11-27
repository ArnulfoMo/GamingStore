<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClasificacionEsrbRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => ['required', 'string', 'max:10', Rule::unique('clasificaciones_esrb', 'codigo')->ignore($this->route('clasificacion'))],
            'nombre' => 'required|string|max:80',
            'edad_minima' => 'required|integer|min:0|max:127',
            'descripcion' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no puede superar :max caracteres.',
            'unique' => 'Este :attribute ya está registrado.',
            'edad_minima.integer' => 'La edad mínima debe ser un número entero.',
            'edad_minima.min' => 'La edad mínima no puede ser negativa.',
            'edad_minima.max' => 'La edad mínima no puede superar los 127 años.',
        ];
    }
}
