<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateUserRequest extends FormRequest
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
        return [
            'balance' => 'nullable|integer',
            'is_seller' => 'boolean',
            'is_banned' => 'boolean',
            'commission' => 'nullable|numeric|min:0|max:0.8',
            'is_affiliate' => 'boolean',
            'affiliate_code' => 'nullable|string|max:250|unique:users,affiliate_code,' . request()->route('id'),
            'affiliate_commission' => 'nullable|numeric|min:0|max:0.8',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_seller' => $this->is_seller == 'on',
            'is_banned' => $this->is_banned == 'on',
            'is_affiliate' => $this->is_affiliate == 'on',
            'commission' => $this->commission / 100,
            'affiliate_commission' => $this->affiliate_commission / 100,
        ]);
    }
}
