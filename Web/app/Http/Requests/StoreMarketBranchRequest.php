<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarketBranchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => "required|regex:/^[\pL\s\-]+$/u",
            'longitude' => "required",
            'latitude' => "required",
            'market_id' => "required"
        ];
    }


    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'name.regex' => __('validation.regex'),
            'longitude.required' => __('validation.required'),
            'latitude.required' => __('validation.required'),
            'market_id.required' => __('validation.required'),
        ];
    }
}
