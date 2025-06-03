<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseInvoiceDetailResource extends JsonResource
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
            'product_item'=>new ProductItemResource($this->productItem),
            'quantity'=>$this->quantity,
            'unit_cost'=>$this->unit_cost,
            'created_at'=>$this->created_at->format('Y-m-d')

        ];
    }
}
