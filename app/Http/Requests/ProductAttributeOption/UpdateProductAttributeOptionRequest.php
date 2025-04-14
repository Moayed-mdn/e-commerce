<?php

namespace App\Http\Requests\ProductAttributeOption;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductAttributeOptionRequest extends FormRequest
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
            "product_attribute_id"=>['required_without:value','exists:product_attribute_options,id'],
            "value"=>['nullable','string','unique:product_attribute_options,value,'.$this->product_attribute_option->id.',id']
        ];            

    }
}
