<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AddressRequest extends FormRequest
{
    public function rules()
    {
        return [
            'street' => 'string|max:255',
            'street_number' => 'string|max:255',
            'zip' => 'numeric|digits:5',
            'city' => 'numeric|max:255|exists:cities,id',
        ];
    }
    public function messages()
    {
        return [
            'street' => __('form.street'),
            'street_number' => __('form.street_number'),
            'zip' => __('form.zip'),
            'city' => __('form.city'),
            'city.exists' => __('validation.exists'),
        ];
    }

    public function authorize()
    {
        return true;
    }
}
