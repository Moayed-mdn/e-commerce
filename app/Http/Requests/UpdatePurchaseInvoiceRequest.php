<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseInvoiceRequest extends FormRequest
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
            'invoice_number'=> ['required','string','max:255','unique:purchase_invoices,invoice_number'],
            // 'supplier_id'=> ['required','integer','exists:suppliers,id'],
            
            // 'purchase_invoice_details'=> ['nullable','array','min:1'],
            // 'purchase_invoice_details.*.unit_cost'=> ['required_with:purchase_invoice_details','numeric','min:0'],
            // 'purchase_invoice_details.*.quantity'  => ['required_with:purchase_invoice_details','integer','min:1'],        
            // 'purchase_invoice_details.*.product_item_id' => ['nullable','integer','exists:product_items,id'],

            // 'purchase_invoice_details.*.product_id' => ['nullable','integer','exists:products,id'],
            // 'purchase_invoice_details.*.quantity'  => ['required_with:purchase_invoice_details.*.product_id','integer','min:1'],        
            // 'purchase_invoice_details.*.price'  => ['required_with:purchase_invoice_details.*.product_id','numeric','min:0'],
            // 'purchase_invoice_details.*.mfg'          => ['nullable','date'],
            // 'purchase_invoice_details.*.exp'          => ['nullable','date','after_or_equal:today']
        ];
    }
}
