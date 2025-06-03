<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'parent'=>new CategoryResource($this->parent) ,
            'name'=>$this->name,
            'created_at'=>$this->created_at->format('Y-m-d'),
            'attributes'=>ProductAttributeResource::collection($this->productAttributes)
        ];
    }
}
