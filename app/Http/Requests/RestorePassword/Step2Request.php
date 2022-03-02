<?php

namespace App\Http\Requests\RestorePassword;

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
            'pin' => 'required|int',
        ];
    }
}
