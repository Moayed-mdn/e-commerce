<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;;

class StoreCategoryRequest extends FormRequest
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
            "name"=>['required','string',"max:255",'unique:categories,name'],
            'parent_id'=>['nullable','exists:categories,id'],
            'product_attributes'=>['nullable','array','min:1'],
            'product_attributes.*.name'=>['required','string','max:255','distinct']  
        ];
    }


    public function messages(){


         return [
            'product_attributes.*.name.distinct' => 'Product attribute  must be unique.',
           
        ];
    }
}
