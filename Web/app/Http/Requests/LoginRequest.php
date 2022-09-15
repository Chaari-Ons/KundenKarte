<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.email' => __('validation.email'),
            'password' => __('validation.required')
        ];
    }

    public function authorize()
    {
        return true;
    }
}
