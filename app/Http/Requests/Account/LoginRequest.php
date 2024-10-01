<?php

namespace App\Http\Requests\Account;

use App\Utilities\EmailUtility;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required|string|max:250',
            'password' => 'required|string|max:250',
            'g-recaptcha-response' => 'required|recaptcha'
        ];
    }


    protected function prepareForValidation()
    {
        if ($this->username && strpos($this->username, '@gmail.com') !== false) {
            $this->merge([
                'username' => EmailUtility::getProccessedGmail($this->username),
            ]);
        }
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'
        ];
    }
}
