<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class Step3DoctorRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'date_b' => 'required|date',
            'avatar_id' => 'nullable|integer|exists:uploaded_file,id',
            'note' => 'nullable|string',
            'price' => 'required|integer',
        ];
    }
}
