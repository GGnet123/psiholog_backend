<?php

namespace App\Http\Requests\Profile\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorProfileRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'card_data' => 'required|string|max:255',
            'date_b' => 'required|date',
            'avatar_id' => 'nullable|integer|exists:uploaded_file,id',
            'note' => 'nullable|string',
            'price' => 'required|integer',
        ];
    }
}
