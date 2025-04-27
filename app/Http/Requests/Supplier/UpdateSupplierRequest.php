<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
class UpdateSupplierRequest extends FormRequest
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
            'name'=>['required_without_all:address,description,communication_methods','string','unique:suppliers,name'],
            'address'=>['nullable','string'],
            'description'=>['nullable','string'],
            'communication_methods'=>['nullable','array','min:1'], 
            'communication_methods.*.communication_method_id'=>['required_with:communication_methods','exists:communication_methods,id'],
            'communication_methods.*.contact_detail'=>['required_with:communication_methods','string','unique:communication_method_supplier,contact_detail,'. $this->supplier->id .',id'],
        ];
    }
}
