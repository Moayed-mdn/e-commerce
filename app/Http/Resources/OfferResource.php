<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "percentage"=>$this->percentage,
            "start_date"=>$this->start_date,
            "end_date"=>$this->end_date,
            "description"=>$this->description,
            "offer_details"=>OfferDetailsResource::collection($this->offerDetails)
            
        ];
    }
}
