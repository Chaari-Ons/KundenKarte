<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarketRequest extends FormRequest
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
            'name' => "required|regex:/^[\pL\s\-]+$/u",
            'logo' => "required|image|file|max:600"
        ];
    }


    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'name.regex' => __('validation.regex'),
            'logo.required' => __('validation.required'),
            'logo.file' => __('validation.file'),
            'logo.image' => __('validation.image'),
            'logo.size' => __('validation.size')
        ];
    }
}
