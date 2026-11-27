<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePerfilRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:150'],
            'gamertag' => ['required', 'string', 'max:50', Rule::unique('users', 'gamertag')->ignore($this->user())],
            'email' => ['required', 'email', 'max:254', Rule::unique('users', 'email')->ignore($this->user())],
            'telefono' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9][0-9\s().-]*$/'],
            'fecha_nacimiento' => ['nullable', 'date_format:Y-m-d', 'before_or_equal:'.now('America/Tegucigalpa')->toDateString()],
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
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede superar los 20 caracteres.',
            'telefono.regex' => 'Introduce un teléfono válido con números y, si lo necesitas, +, espacios, paréntesis, puntos o guiones.',
            'fecha_nacimiento.date_format' => 'Introduce una fecha de nacimiento válida.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',
        ];
    }
}
