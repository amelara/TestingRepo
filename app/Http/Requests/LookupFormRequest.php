<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LookupFormRequest extends FormRequest
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
            'email' => 'sometimes|email|max:50|nullable',
            'member_id' => 'sometimes|digits:12|nullable',
            'username' => 'sometimes|alpha_dash|nullable',
            'password' => 'sometimes|alpha_dash|nullable',
            'cc_number' => 'sometimes|min:18|max:19|nullable'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Please provide a valid Email Address.'
        ];
    }
}
