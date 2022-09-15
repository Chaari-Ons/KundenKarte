<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use function Symfony\Component\Finder\in;

class UserRequest extends ProfileRequest
{
    protected $except = [
        'register'
    ];

    public function rules()
    {
        return array_merge(parent::rules(), [
            'email' => 'sometimes|required|unique:users|email',
            'current_password' => 'sometimes|required|current_password',
            'password' => [Password::min(8)->numbers()->mixedCase()->uncompromised(3), 'sometimes|required', 'confirmed'],
            'name' => 'sometimes|required',
            'lastname' => 'sometimes|required'
        ]);
    }
    public function messages()
    {
        return [
            'email.required' => __('validation.required'),
            'email.unique' => __('validation.email_unique'),
            'email.email' => __('validation.email'),
            'current_password.current_password' => __('validation.current_password'),
            'current_password.required' => __('validation.required'),
            'password.required' => __('validation.required'),
            'password.confirmed' => __('validation.confirmed'),
            'name.required' => __('validation.required'),
            'lastname.required' => __('validation.required'),
        ];
    }

    public function authorize()
    {
        $user = Auth::user();
        $action = $this->route()->getActionMethod();

        if(in_array($action, $this->except) || ($user && $user->tokenCan('user:' . $action)))
        {
            return true;
        }

        return false;
    }
}
