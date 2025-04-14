<?php

namespace App\Http\Requests\ProductItem;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductItemRequest extends FormRequest
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
            "product_id"=>['required','exists:products,id'],
            "quantity"=>['required','integer','min:1'],
            "price"=>['required','numeric','min:0.01'],
            "product_image"=>['nullable','string'],
            "mfg"=>['required_with:exp','date_format:Y/m/d','before_or_equal:today'],
            "exp"=>['required_with:mfg','date_format:Y/m/d','after:mfg'],
            "attribute_option_ids"=>['nullable','array','min:1'],
            "attribute_option_ids.*"=>['required_with:attribute_option_ids','exists:product_attribute_options,id']
        ];
    }
}
