<?php

namespace App\Http\Requests\Account;

use App\Models\User;
use App\Utilities\EmailUtility;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:users,email|email',
            'username' => 'required|string|min:3|max:20|unique:users,username',
            'nickname' => 'required|string|min:3|max:20',
            'password' => 'required|string|min:6|max:20',
            'password_confirmation' => 'required|same:password',
            'referrer' => 'nullable|exists:users,id',
            'g-recaptcha-response' => 'required|recaptcha'

        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'email' => strtolower($this->email),
            'username' => strtolower($this->username),
            'nickname' => strtolower($this->nickname),
        ]);


        $ref = isset($_COOKIE['ref']) ? $_COOKIE['ref'] : null;

        if ($ref && strlen($ref) < 20) {
            $affiliate = User::where('affiliate_code', $ref)->first();
            if ($affiliate) {
                $this->merge([
                    'referrer' => $affiliate->id,
                ]);
            }
        }


        if ($this->email && strpos($this->email, '@gmail.com') !== false) {
            $this->merge([
                'email' => EmailUtility::getProccessedGmail($this->email),
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
