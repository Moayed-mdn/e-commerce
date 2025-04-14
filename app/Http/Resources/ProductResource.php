<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "brand"=>$this->brand,
            "category"=>new CategoryResource($this->category),
            "image_url"=>$this->product_image,
            "description"=>$this->description,

        ];
    }
}
