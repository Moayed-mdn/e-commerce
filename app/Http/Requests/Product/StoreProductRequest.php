<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        Log::warning("iam stoer");
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
            "name"=>['required','string','unique:products,name'],
            "brand_id"=>['required','exists:brands,id'],
            "category_id"=>['required','exists:categories,id'],
            "product_image"=>['nullable','image','mimes:png,jpg,jpeg','max:2048'], 
            "description"=>['nullable','string']
        ];
    }
}
