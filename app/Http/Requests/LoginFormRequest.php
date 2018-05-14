<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'username' => 'sometimes|alpha_dash|nullable',
            'password' => 'sometimes|alpha_dash|nullable',
            'cc_number' => 'sometimes|min:18|max:19|nullable'
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
