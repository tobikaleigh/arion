<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'internal_id'                   => 'required|string|max:255|unique:products,internal_id',
            'name'                          => 'required|string|max:255',
            'description'                   => 'nullable|string|max:65535',
            'inventory_location_name'       => 'required|string|max:255',
            'inventory_location_quantity'   => 'required|integer|min:0|max:1000',
        ];
    }
}
