<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'gamertag' => ['required', 'string', 'max:50', 'unique:users,gamertag'],
            'email' => ['required', 'email', 'max:254', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Escribe tu nombre completo.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no puede superar los 150 caracteres.',
            'gamertag.required' => 'Escribe tu gamertag.',
            'gamertag.string' => 'El gamertag debe ser texto.',
            'gamertag.max' => 'El gamertag no puede superar los 50 caracteres.',
            'gamertag.unique' => 'Este gamertag ya está en uso.',
            'email.required' => 'Escribe tu correo electrónico.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'email.max' => 'El correo no puede superar los 254 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'Escribe una contraseña.',
            'password.string' => 'La contraseña debe ser texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }
}
