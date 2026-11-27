<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'activo' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'activo.required' => 'Indica si la cuenta debe estar activa.',
            'activo.boolean' => 'El estado de la cuenta no es válido.',
        ];
    }
}
