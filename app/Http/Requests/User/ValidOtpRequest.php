<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
class ValidOtpRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_number' => ['required_without:email', 'string'],
            'email' => ['required_without:phone_number', 'email'],
            'otp' => ['required', 'string', 'size:6']
        ];
    }
}
