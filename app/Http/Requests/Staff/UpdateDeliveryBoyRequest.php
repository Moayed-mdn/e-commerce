<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryBoyRequest extends FormRequest
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
            'first_name'=> ['required_without_all:last_name,username,password,birth_day,gender,phone_number','string','max:255'],
            'last_name'=> ['nullable','string','max:255'],
            'username'=> ['nullable','string','regex:/^[a-zA-Z]+_[a-zA-Z]+$/','min:3','max:255','unique:delivery_boys,username,'. $this->deliveryBoy->id . ',id' ],
            'password'=> ['nullable','string','min:8','confirmed'],
            'birth_day'=> ['nullable','date_format:Y/m/d'],
            'gender'=> ['nullable','in:male,female'],
            'phone_number'=> ['nullable','string','max:255','unique:delivery_boys,phone_number']
        ];
    }

   
}
