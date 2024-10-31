<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string> Validation rules
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
