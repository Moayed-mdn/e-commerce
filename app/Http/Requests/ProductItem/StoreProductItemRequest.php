<?php

namespace App\Http\Requests\ProductItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
 use Illuminate\Contracts\Validation\Validator;
 use Illuminate\Validation\Rule;

class StoreProductItemRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
  public function rules(): array
  {
                    return [
                    "product_id" => [
                    'required',
                    'exists:products,id',
                    Rule::exists('products', 'id')->where(function ($query) {
                    $query->where('category_id', function ($subQuery) {
                    $subQuery->select('category_id')
                    ->from('products')
                    ->where('id', $this->input('product_id'));
                    });
                    }),
                    ],
                    "quantity" => ['required', 'integer', 'min:1'],
                    "price" => ['required', 'numeric', 'min:0.01'],
                    "product_image" => ['nullable', 'image', 'mimes:png,jpg,jpeg,avif', 'max:2048'],
                    "mfg" => ['nullable', 'required_with:exp', 'date_format:Y-m-d', 'before_or_equal:today'],
                    "exp" => ['nullable', 'required_with:mfg', 'date_format:Y-m-d', 'after:mfg'],
                    "attribute_option_ids" => ['nullable', 'array', 'min:1'],
                    "attribute_option_ids.*" => [
                    'required_with:attribute_option_ids',
                    'exists:product_attribute_options,id',
                    Rule::exists('product_attribute_options', 'id')->where(function ($query) {
                    $query->whereIn('product_attribute_id', function ($subQuery) { 
                    $subQuery->select('id')
                    ->from('product_attributes')
                    ->where('category_id', function ($subSubQuery) {
                    $subSubQuery->select('category_id')
                    ->from('products')
                    ->where('id', $this->input('product_id'));
                    });
                    });
                    }),
                    ],
                    ];


    //                  return [
    //     "product_image" => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
    // ];
  }

  public function messages(): array
  {
  return [
  'product_id.exists' => 'The selected product id is invalid or does not belong to the specified category.',
  'attribute_option_ids.*.exists' => 'One or more of the selected attribute options are invalid or do not belong to the product\'s category.',
  ];
  } 

   /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
