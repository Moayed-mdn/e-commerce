<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            'id'=>$this->id,
            'make'=>$this->make,
            'model'=>$this->model,
            'year'=>$this->year,
            'vin'=>$this->vin, 
            'vehicle_type'=>new VehicleTypeResrouce($this->vehicleType),
            'status'=>$this->status,
        ];
    }
}
