<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')->whereIn('nombre', ['administrador', 'operador', 'cliente'])],
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'Selecciona un rol.',
            'role_id.integer' => 'El rol seleccionado no es válido.',
            'role_id.exists' => 'El rol seleccionado no es válido.',
        ];
    }
}
