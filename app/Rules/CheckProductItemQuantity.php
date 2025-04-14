<?php

namespace App\Rules;

use App\Models\ProductItem;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckProductItemQuantity implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $itemIndex=explode('.',$attribute)[1];
        $inputName='offer_details.'.$itemIndex.'.id';
        $productItemId=request()->input($inputName);
        $productItem = ProductItem::find($productItemId);

        if ($value > $productItem->quantity)
            $fail('The quantity for product item ' . $productItem->name . ' exceeds the available stock.');
    
    }    
}
