<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
class CreateDeliveryBoyAccountRequest extends FormRequest
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
            'first_name'=> ['required','string','max:255'],
            'last_name'=> ['required','string','max:255'],
            'username'=> ['required','string','regex:/^[a-zA-Z]+_[a-zA-Z]+$/','min:3','max:255','unique:delivery_boys'],
            'password'=> ['required','string','min:8','confirmed'],
            'birth_date'=> ['required','date_format:Y-m-d'],
            'gender'=> ['required','in:male,female'],
            'phone_number'=> ['required','string','max:255','unique:delivery_boys']
        ];
    }
}
