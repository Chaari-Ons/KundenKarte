<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'regex:/^[\pL\s\-]+$/u',
            'logo' => 'file|image|max:512'
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => __('validation.regex'),
            'logo.file' => __('validation.file'),
            'logo.image' => __('validation.image'),
            'logo.size' => __('validation.size')
        ];
    }
}
