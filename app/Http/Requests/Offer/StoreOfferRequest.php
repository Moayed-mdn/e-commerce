<?php

namespace App\Http\Requests\Offer;

use App\Rules\CheckProductItemQuantity;
use Illuminate\Foundation\Http\FormRequest;
class StoreOfferRequest extends FormRequest
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
            "name"=>['required','string'],
            "percentage"=>['required','integer','min:1','max:99'],
            "start_date"=>['required','date_format:Y/m/d','after_or_equal:today'],
            "end_date"=>['required','date_format:Y/m/d','after:start_date'],
            "description"=>['nullable','string'],
            "offer_details"=>['required','array','min:1'],
            "offer_details.*.id"=>['required','exists:product_items,id'],
            "offer_details.*.quantity"=>['required','integer','min:1',new CheckProductItemQuantity()]
            
        ];
    }
}
