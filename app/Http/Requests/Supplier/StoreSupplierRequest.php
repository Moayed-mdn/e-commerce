<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name'=>['required','string','unique:suppliers,name'],
            'address'=>['required','string'],
            'description'=>['required','string'],
            'communication_methods'=>['required','array','min:1'],
            'communication_methods.*.communication_method_id'=>['required','exists:communication_methods,id'],
            'communication_methods.*.contact_detail'=>['required','string','unique:communication_method_supplier,contact_detail'],
            
        ];
    }
}
