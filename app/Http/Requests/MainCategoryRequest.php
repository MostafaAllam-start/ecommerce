<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|array',
            'category.*.name' => 'required|string',
            'category.*.abbr' => 'required|string',
            'category.*.active' => 'required|in:0,1',
        ];
    }
    public function messages(): array{
        return [
            'required' => 'هذا الحقل مطلوب.',
            'string' => 'هذا الحقل يجب أن يكون احرف.',
            'in' => 'القيمة المدخلة غير صحيحة.',
            'photo.mimes' => 'امتداد الصورة يجب أن يكون من نوع jpeg,png,jpg,gif,svg ',
            'photo.max' => 'حجم الصورة يجب أن يكون الا يزيد عن 2MB '
        ];
    }
}
