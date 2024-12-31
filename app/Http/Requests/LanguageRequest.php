<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'abbr' => 'required|string|max:255',
            'direction' => 'required|in:rtl,ltr',
            'is_active' => 'required|  in:0,1',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'اسم اللغة مطلوب.',
            'name.string' => 'اسم اللغة يجب ان يكون حروف فقط.',
            'name.max' => 'اسم اللغة يجب الا يزيد عن 255 حرف',
            'abbr.required' => 'اختصار اللغة مطلوب.',
            'abbr.string' => 'اختصار اللغة يجب ان يكون حروف فقط.',
            'abbr.max' => 'اختصار اللغة يجب الا يزيد عن 255 حرف',
            'direction.required' => 'اتجاه اللغة مطلوب.',
            'direction.in' => 'اتجاه اللغة يجب ان يكون rtl او ltr .',
            'is_active.required' => 'هذا الحقل مطلوب.'
        ];
    }
}
