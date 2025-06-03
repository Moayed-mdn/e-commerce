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
            
            'communication_methods.0.contact_detail' => ['email'],

            
            'communication_methods.1.contact_detail' => ['min:8', 'max:10'],
        ]; 
    }


    public function messages(): array
    {
        return [
            'communication_methods.0.contact_detail.required' => 'The Email contact detail field is required',
            'communication_methods.1.contact_detail.required' => 'The Phone Number contact detail field is required',
             'communication_methods.1.contact_detail.min' => 'The Phone Number must be at least :min characters',
            'communication_methods.1.contact_detail.max' => 'The Phone Number may not be more than :max characters',
            'communication_methods.0.contact_detail.email' => 'The Email contact detail must be a valid email address',
        ];

    }
    
}
