<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;;

class UpdateCategoryRequest extends FormRequest
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
        'name' => ['required_without_all:parent_id,product_attributes', 'max:255','unique:categories,name,' . $this->category->id . ',id'],
        'parent_id' => [
            'sometimes', 
            'string',      
            function ($attribute, $value, $fail) {
                if ($value === 'no_parent') {
                    return; 
                }

                
                if (!Category::where('id', $value)->exists()) {
                    $fail('The selected parent_id is invalid.');
                }

                if ($value == $this->category->id) {
                    $fail('Cannot set a category as its own parent.');
                }

                
                if ($this->isCircularReference($value)) {
                    $fail('This parent category would create a circular reference.');
                }

                
                if ($this->isParentBecomingChild($value)) {
                    $fail('Cannot make a category a parent of its own parent.');
                }
            },
        ],
        'product_attributes'=>['nullable','array','min:1'],
        'product_attributes.*.id'=>['exists:product_attributes,id']
    ];
}



protected function isCircularReference($parentId): bool
{
    $currentCategoryId = $this->category->id;
    $checkedIds = [];
    $nextParentId = $parentId;

    while ($nextParentId !== null) {
        
        if (in_array($nextParentId, $checkedIds, true)) {
            return true;
        }

        
        if (count($checkedIds) > 100) { 
            throw new \RuntimeException('Possible infinite loop in category hierarchy');
        }

        $checkedIds[] = $nextParentId;
        
        
        $category = Category::find($nextParentId);
        $nextParentId = $category?->parent_id;

        
        if ($nextParentId === $currentCategoryId) {
            return true;
        }
    }

    return false;
}

    protected function isParentBecomingChild($parentId): bool
    {
        
        $parentCategory = Category::find($parentId);
        return $parentCategory && $parentCategory->parent_id === $this->category->id;
    }
}

