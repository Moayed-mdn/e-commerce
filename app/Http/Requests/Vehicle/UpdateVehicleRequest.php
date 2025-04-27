<?php

namespace App\Http\Requests\Vehicle;

use App\Enums\VehicleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
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
            'make'=>['required_without_all:model,year,vin,vehicle_type_id,status','string'],
            'model'=>['nullable','string'],
            'year'=>['nullable','digits:4', 'integer', 'between:1990,' . date('Y')],
            'vin'=>['nullable','max:17','unique:vehicles,vin'],
            'vehicle_type_id'=>['nullable','exists:vehicle_types,id'],
            'status'=>['nullable',Rule::in(VehicleStatus::getStatus())]
        ];
    }
}
