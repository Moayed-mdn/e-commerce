<?php

namespace App\Http\Requests\OfferDetails;

use Illuminate\Foundation\Http\FormRequest;
class StoreOfferDetailsRequest extends FormRequest
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
            "offer_id"=>['required'],
            "product_item_id"=>['required','exists:product_items,id'],
            "quantity"=>['required','integer','min:1']
            
        ];
    }
}
