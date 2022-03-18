<?php

namespace App\Http\Requests\CreatePassword;

use Illuminate\Foundation\Http\FormRequest;

class CheckLoginRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required|int'
        ];
    }
}
