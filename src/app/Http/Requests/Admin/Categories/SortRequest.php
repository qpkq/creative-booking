<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SortRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sort_field'        => 'nullable|string|in:title,created_at',
            'sort_direction'    => 'nullable|string|in:asc,desc',
        ];
    }
}
