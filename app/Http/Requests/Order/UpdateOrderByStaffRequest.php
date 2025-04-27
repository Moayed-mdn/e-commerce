<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;use Illuminate\Validation\Rule;

class UpdateOrderByStaffRequest extends FormRequest
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
            'status'=>['required_without_all:delivery_boy_id,vehicle_id',Rule::in(OrderStatus::getStatus())],
            'delivery_boy_id'=>['nullable','exists:delivery_boys,id'],
            'vehicle_id'=>['nullable','exists:vehicles,id']
        ];
    }
}
