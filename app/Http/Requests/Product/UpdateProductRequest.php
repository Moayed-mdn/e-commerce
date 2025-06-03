<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateProductRequest extends FormRequest
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
            "name"=>['required_without_all:brand_id,category_id,product_image,description','string','unique:products,name,'.$this->product->id .',id'],
            "brand_id"=>['nullable','exists:brands,id'],
            "category_id"=>['nullable','exists:categories,id'],
            "product_image"=>['nullable','image','mimes:png,jpg,jpeg','max:2048'], 
            "description"=>['nullable','string']
        ];
    }
}
