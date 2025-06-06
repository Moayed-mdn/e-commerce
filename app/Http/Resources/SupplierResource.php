<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
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
            'name'=>$this->name,  
            'address'=>$this->address,
            'description'=>$this->description,
            "communication"=>CommunicationMethodResource::collection($this->communicationMethods),
            'created_at'=>$this->created_at->format('Y-m-d')

        ];
    }
}
