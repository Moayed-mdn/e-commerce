<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductItemResource extends JsonResource
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
            "product_attributes"=>$this->product->category->productAttributes,
            'product_name'=>$this->product->name,
            'product_id'=>$this->product->id,
            'product'=>$this->product,
            'quantity'=>$this->quantity,
            'price'=>$this->price,
            'product_image'=>$this->product_image,
            'mfg'=>$this->mfg,
            'exp'=>$this->exp,
            "attributes"=>ProductAttributeOptionResource::collection($this->attributeOptions),
            'created_at'=>$this->created_at->format('Y-m-d')
        ];
    }
}
