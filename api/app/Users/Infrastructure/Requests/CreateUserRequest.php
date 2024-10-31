<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string> Validation rules
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function authorize(): bool
    {
        return true; // Asegúrate de que el usuario esté autorizado para crear un usuario
    }
}
