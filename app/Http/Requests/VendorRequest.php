<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'email' => 'required|email|unique:vendors,email,'.$this->id,
            'phone' => 'required|string|unique:vendors,phone,'.$this->id,
            'address' => 'required|string',
            'logo' => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => "required|exists:categories,id",
            'is_active' => 'required|in:0,1',
            'password' => 'required_without:id|nullable|string|min:8',
            'longitude' => 'required_with:latitude|max:30|nullable',
            'latitude' => 'required_with:longitude|max:30|nullable',
        ];
    }
    public function messages():array{
        return [
            'required' => 'هذا الحقل مطلوب.',
            'required_without' => 'هذا الحقل مطلوب.',
            'string' => 'هذا الحقل يجب ان يكون حروف فقط.',
            'email' => 'الايميل غير صحيح.',
            'image'=> 'هذا الحقل يجب ان يكون صورة.',
            'logo.mimes' => 'الصورة يجب ان تكون بامتداد gif ,jpeg, jpg, png, svg.',
            'logo.max' => 'حجم الصورة يجب الا يزيد عن 2MB.',
            'is_active.in' => 'هذا الحقل يجب ان يكون اما 0 او 1.',
            'category_id.exists' => 'هذا القسم غير موجود.',
            'email.unique' => 'هذا الايميل موجود بالفعل.',
            'phone.unique' => 'رقم الهاتف موجود بالفعل.',
            'password.min' => 'كلمة المرور يجب الا تقل عن 8 حروف.'
        ];
    }
}
