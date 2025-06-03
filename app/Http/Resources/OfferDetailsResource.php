<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferDetailsResource extends JsonResource
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
            "product_item"=>new ProductItemResource($this->productItem),
            "quantity"=>$this->quantity,
            'created_at'=>$this->created_at->format('Y-m-d') 

        ];
    }
}
