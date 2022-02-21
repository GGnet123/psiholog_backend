<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class Step3UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'avatar_id' => 'nullable|integer|exists:uploaded_file,id',
        ];
    }
}
