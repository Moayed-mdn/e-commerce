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
            'vehicle_type'=>$this->vehicle_type,
            'status'=>$this->status,
            'created_at'=>$this->created_at->format('Y-m-d')
        ];
    }
}
