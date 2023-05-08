<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title'             => 'string|max:255',
            'content'           => 'string|max:255',
            'image'             => 'file',
            'category_id'       => 'integer|exists:categories,id',
            'tags_ids'          => 'nullable|array',
            'tags_ids.*'        => 'nullable|integer|exists:tags,id',
        ];
    }
}
