<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
class CompleteProfileRequest extends FormRequest
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
            'userId'=>['required','exists:users,id'], 
            'first_name'=>['required','string','min:3','max:12'],
            'last_name'=>['required','string','min:3','max:12'],
            'birth_date'=>['required','date_format:Y-m-d'],
            'gender'=>['required','in:male,female'],
            
        ];
      
    }
}
