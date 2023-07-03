<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

    public function rules()
    {
        return [
            'login' => 'required|string|max:255',
            'code' => 'string|max:255|nullable'
        ];
    }
}
