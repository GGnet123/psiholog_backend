<?php

namespace App\Http\Requests\RestorePassword;

use Illuminate\Foundation\Http\FormRequest;

class Step3Request extends FormRequest
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
            'pin' => 'required|int',
            'sessionInfo' => 'string',
            'password' => 'required|string|max:255',
            're_password' => 'required|string|max:255|same:password',
        ];
    }
}
