<?php

namespace App\Http\Requests\CreatePassword;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
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
            'password' => 'required|string|max:255',
            're_password' => 'required|string|max:255|same:password',
            'pin' => 'required|int'
        ];
    }
}
