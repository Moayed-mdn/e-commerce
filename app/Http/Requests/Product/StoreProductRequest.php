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
            "name"=>['required','string'],
            "brand_id"=>['required','exists:brands,id'],
            "category_id"=>['required','exists:categories,id'],
            "product_image"=>['nullable','string'],
            "description"=>['nullable','string']
        ];
    }
}
