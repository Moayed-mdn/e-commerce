<?php

namespace App\Http\Requests\ProductItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductItemRequest extends FormRequest
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
            "product_id"=>['required_without_all:quantity,price,product_image,mfg,exp,attribute_option_ids','exists:products,id'],
            "quantity"=>['nullable','integer','min:1'],
            "price"=>['nullable','numeric','min:0.01'],
            "product_image"=>['nullable','string'],
            "mfg"=>['nullable','string','date_format:Y/m/d','before_or_equal:today'],
            "exp"=>['nullable','string','date_format:Y/m/d','after:mfg'],
            "attribute_option_ids"=>['nullable','array','min:1'], 
            "attribute_option_ids.*"=>['required_with:attribute_option_ids','unique:product_item_attribute_options,product_attribute_option_id','exists:product_attribute_options,id']
            
        ];
    }
}
