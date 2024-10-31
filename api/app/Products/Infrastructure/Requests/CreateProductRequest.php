<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'date_add' => 'nullable|date',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
