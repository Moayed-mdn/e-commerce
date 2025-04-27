<?php

namespace App\Http\Requests\Vehicle;

use App\Enums\VehicleStatus;
use Illuminate\Foundation\Http\FormRequest;;
use Illuminate\Validation\Rule;

class StoreVehicleRequest extends FormRequest
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
            'make'=>['required','string'],
            'model'=>['required','string'],
            'year'=>['required','date_format:Y','before_or_equal:now','after:1990'],
            'vin'=>['required','unique:vehicles,vin'],
            'vehicle_type_id'=>['required','exists:vehicle_types,id'],
            'status'=>['required',Rule::in(VehicleStatus::getStatus())]
        ];
    }
}
