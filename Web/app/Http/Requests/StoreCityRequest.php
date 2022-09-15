<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreCityRequest extends FormRequest
{
    #[ArrayShape(['name' => "string"])] public function rules(): array
    {
        return [
            'name' => 'required|unique:cities'
        ];
    }

    #[ArrayShape(['name.required' => "mixed", 'name.unique' => "mixed"])] public function messages(): array
    {
        return [
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique')
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
