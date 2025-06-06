<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeOptionResource extends JsonResource
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
            "product_attribute"=>$this->productAttribute,
            "value"=>$this->value,
            'created_at'=>$this->created_at->format('Y-m-d')

        ];
    }
}
