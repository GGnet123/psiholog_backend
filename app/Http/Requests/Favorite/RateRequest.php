<?php

namespace App\Http\Requests\Favorite;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'doctor_id' => 'required|integer',
            'rate' => 'required|integer',
            'comment' => 'nullable|string'
        ];
    }
}
