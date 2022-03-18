<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FirebaseAuthRequest extends FormRequest
{

    public function rules()
    {
        return [
            'firebase_token' => 'required|string',
            'firebase_provider' => 'required|string'
        ];
    }
}
