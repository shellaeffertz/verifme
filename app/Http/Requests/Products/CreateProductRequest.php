<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $products = config('products');
        if (!isset($products[$this->type])) return [];

        $product = $products[$this->type];

        $rules = [
            'type' => 'required|string',
            'title' => 'required|string|max:255',
            'delivery_type' => 'required|string|in:instant,preorder',
            'delivery_period' => 'required_if:delivery_type,preorder|string|max:255',
            'price' => 'required|numeric',
            'public_data' => 'nullable|string|max:10000',
            'private_data' => 'nullable|string|max:10000',
        ];

        $public_fields = $product['public'];
        $private_fields = $product['private'];

        foreach ($public_fields as $field => $rule) {
            $rules[$field] = $rule;
        }

        foreach ($private_fields as $field => $rule) {
            $rules[$field] = $rule;
        }
        
        return $rules;
    }


    protected function prepareForValidation()
    {
        $type = $this->type;
        if (!$type) {
            $this->getValidatorInstance()->after(function ($validator) {
                $validator->errors()->add('type', 'Product type is required');
            });
            return;
        }

        $all_fields = $this->all();
        $products = config('products');

        if (!isset($products[$type])) {
            $this->getValidatorInstance()->after(function ($validator) {
                $validator->errors()->add('type', 'Product type is invalid');
            });
            return;
        }

        $product = $products[$type];

        $public_fields = $product['public'];
        $private_fields = $product['private'];
        $requires_check = $product['requires_check'];
        if($requires_check) {
            // TODO: Implement check handler
            // $check = CheckHandler::check($type, $data);
            // if(!$check) {
            //     $this->getValidatorInstance()->after(function ($validator) {
            //         $validator->errors()->add('Data', 'We couldn\'t verify the account credentials  you provided. Please check them and try again.');
            //     });
            //     return;
            // }
        }

        $public_data = [];
        $private_data = [];

        foreach ($public_fields as $field => $data) {
            $public_data[$field] =  $all_fields[$field] ?? null;
        }

        foreach ($private_fields as $field => $data) {
            $private_data[$field] = $all_fields[$field] ?? null;
        }

        $this->merge([
            'public_data' => json_encode($public_data),
            'private_data' => json_encode($private_data),
        ]);
    }
}
