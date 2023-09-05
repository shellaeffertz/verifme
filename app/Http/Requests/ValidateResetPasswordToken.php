<?php

namespace App\Http\Requests;

use App\Utilities\EmailUtility;
use Illuminate\Foundation\Http\FormRequest;

class ValidateResetPasswordToken extends FormRequest
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
            'token' => 'required|string|max:250'
        ];
    }
}
