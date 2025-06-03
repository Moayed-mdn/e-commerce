<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
class UpdateUserRequest extends FormRequest
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
            'first_name'=>['required_without_all:last_name,birth_date,gender,is_active','string','min:3','max:12'],
            'last_name'=>['nullable','string','min:3','max:12'],
            'birth_date'=>['nullable','date_format:Y-m-d'],
            'gender'=>['nullable','in:male,female'],
            
        ];
    }
}
