<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseInvoiceResource extends JsonResource
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
            'invoice_number'=>$this->invoice_number,
            'supplier'=>new SupplierResource($this->supplier),
            'total'=>$this->purchaseInvoiceDetails()->sum('unit_cost'),
            'invoice_details'=>PurchaseInvoiceDetailResource::collection($this->purchaseInvoiceDetails),
        ];
    }
}
