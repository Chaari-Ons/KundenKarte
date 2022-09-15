<?php

namespace App\Http\Requests;

use App\Models\Profile;
use Illuminate\Validation\Rule;


class ProfileRequest extends AddressRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'gender' => Rule::in(Profile::$gender),
            'date_of_birth' => 'date|date_format:"Y-m-d"',
            'avatar' => 'file|image|max:512'
        ]);
    }
    public function messages()
    {
        return [
            'gender' => __('form.gender'),
            'date_of_birth.date' => __('validation.date'),
            'date_of_birth.date_format' => __('validation.date_format', ['format' => 'Y-m-d' ]),
            'avatar.file' => __('validation.file'),
            'avatar.image' => __('validation.image'),
            'avatar.max' => __('validation.max.file', ['max' => '512']),
        ];
    }

    public function authorize()
    {
        return true;
    }
}
