<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ProductQTYRule;
class StockRequest extends FormRequest
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
            'sku' => 'required|string',
            'manage_stock' => 'required|boolean',
            'qty' => new ProductQTYRule($this->input('manage_stock')),
            'product_id' => 'required|exists:products,id',
            'in_stock' => 'required|boolean',
        ];
    }
}
