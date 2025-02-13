<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'slug' => 'required|string',
            'brand_id' => 'required|integer|exists:brands,id',
            'is_active' => 'required|boolean',
            'categories' => 'required|array|exists:categories,id',
            'tags' => 'required|array|exists:tags,id',
        ];
    }
}
