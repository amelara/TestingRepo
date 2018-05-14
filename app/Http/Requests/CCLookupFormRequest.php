<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CCLookupFormRequest extends FormRequest
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
            //
            'first_digits' => 'required|string',
            'last_digits' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'first_digits.required' => 'First 6 digits are required',
            'last_digits.required' => 'Last 4 digits are required'
        ];
    }
}
