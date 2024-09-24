<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'current_password' => 'string|min:8|max:64|required_with:password',
            'password' => 'string|min:8|max:64|required_with:password_confirmation',
            'password_confirmation' => 'string|min:8|max:64|required_with:password|same:password',
        ];
    }

}
