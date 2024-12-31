<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'is_active' => 'required|boolean',
            'photo' => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل يجب ان يكون حروف',
            'image' => 'هذا الحقل يجب ان يكون صورة',
            'photo.mimes' => 'jpeg, png, jpg, gif, svg امتداد الصورة يجب ان يكون',
            'photo.required_without' => 'هذا الحقل مطلوب'

        ];
    }
}
