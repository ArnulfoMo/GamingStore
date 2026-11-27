<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationAvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'field' => ['required', 'string', Rule::in(['email', 'gamertag'])],
            'value' => $this->input('field') === 'email'
                ? ['required', 'email', 'max:254']
                : ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'field.required' => 'Indica el campo que deseas comprobar.',
            'field.string' => 'El campo debe ser texto.',
            'field.in' => 'Solo se puede comprobar el correo o el gamertag.',
            'value.required' => 'Escribe un valor para comprobar su disponibilidad.',
            'value.string' => 'El valor debe ser texto.',
            'value.email' => 'Introduce un correo electrónico válido.',
            'value.max' => 'El valor no puede superar los :max caracteres.',
        ];
    }
}
