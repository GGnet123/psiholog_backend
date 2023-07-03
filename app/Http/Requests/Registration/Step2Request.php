<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class Step2Request extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required|int',
//            'password' => 'required|string|max:255',
//            're_password' => 'required|string|max:255|same:password',
            'pin' => 'required|int'
        ];
    }
}
