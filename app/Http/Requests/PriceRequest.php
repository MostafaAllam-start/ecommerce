<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
            'price' => 'required|numeric',
            'product_id' => 'required|exists:products,id',
            'special_price' => 'required|numeric',
            'special_price_type' => 'required|string|in:percent,fixed',
            'special_price_start' => 'required|date',
            'special_price_end' => 'required|date',
        ];
    }
}
