<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class Step2EmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string',
//            'password' => 'required|string|max:255',
//            're_password' => 'required|string|max:255|same:password',
            'pin' => 'required|int'
        ];
    }
}
