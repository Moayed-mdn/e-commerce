<?php

namespace App\Http\Requests\PurchaseInvoice;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseInvoiceRequest extends FormRequest
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
            'supplier_id'=> ['required','integer','exists:suppliers,id'],
            
            'purchase_invoice_details'=> ['required','array','min:1'],
            'purchase_invoice_details.*.unit_cost'=> ['required','numeric','min:0'],
            'purchase_invoice_details.*.product_item_id' => ['nullable','integer','exists:product_items,id'],
            
            'purchase_invoice_details.*.quantity'  => ['required','integer','min:1'],        
           
            'purchase_invoice_details.*.product_id' => ['required_without:purchase_invoice_details.*.product_item_id','integer','exists:products,id'],
            'purchase_invoice_details.*.price'  => ['required_with:purchase_invoice_details.*.product_id','numeric','min:0'],
            'purchase_invoice_details.*.mfg'          => ['nullable','date'],
            'purchase_invoice_details.*.exp'          => ['nullable','date','after_or_equal:today']
        ];
    }
}
