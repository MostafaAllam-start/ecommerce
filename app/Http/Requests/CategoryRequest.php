<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories,slug,'.$this->id,
            'is_active' => 'required|in:0,1',
            'type' => 'required|in:1,2',
            'parent_id' => 'required_if:type,2|exists:categories,id',
        ];
    }
}
