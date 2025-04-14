<?php

namespace App\Http\Requests\Offer;

use App\Rules\CheckProductItemQuantity;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        return [
            "name"=>['required_without_all:percentage,start_date,end_date,description,offer_details','string'],
            "percentage"=>['nullable','numeric','min:1','max:99'],
            "start_date"=>['nullable','date_format:Y/m/d','after_or_equal:today'],
            "end_date"=>['nullable','date_format:Y/m/d','after:start_date'],
            "description"=>['nullable','string'],
            "product_ids"=>['nullable','array','min:1'],
            "offer_details"=>['nullable','array','min:1'],
            "offer_details.*.id"=>['nullable','exists:product_items,id'],
            "offer_details.*.quantity"=>['required_with:offer_details','integer','min:1',new CheckProductItemQuantity()]
            
        ];

    }
}
