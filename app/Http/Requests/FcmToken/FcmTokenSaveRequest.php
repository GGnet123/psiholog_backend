<?php

namespace App\Http\Requests\FcmToken;

use Illuminate\Foundation\Http\FormRequest;

class FcmTokenSaveRequest extends FormRequest
{

    public function rules()
    {
        return [
            'fcm_token' => 'required|string|max:255'
        ];
    }
}
