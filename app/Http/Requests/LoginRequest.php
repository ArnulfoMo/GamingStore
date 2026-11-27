<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Escribe tu correo electrónico.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'email.max' => 'El correo no puede superar los 254 caracteres.',
            'password.required' => 'Escribe tu contraseña.',
            'password.string' => 'La contraseña debe ser texto.',
            'remember.boolean' => 'La opción de recordar sesión no es válida.',
        ];
    }
}
