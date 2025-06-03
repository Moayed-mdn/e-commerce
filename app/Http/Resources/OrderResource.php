<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_number'=>  $this->order_number,
            'user_id'=>   new UserResource($this->user),
            'status'=>   $this->status,
            'address_id'=>  new AddressResource($this->address),
            'payment_method_id'=> new AddressResource($this->paymentMethod),
            'delivery_boy_id'=>  new DeliveryBoyResource($this->deliveryBoy),
            'vehicle_id'=>   new VehicleResource($this->vehicle),
            'total'=>   $this->total,
            'created_at'=>$this->created_at->format('Y-m-d')

        ];
    }
}
