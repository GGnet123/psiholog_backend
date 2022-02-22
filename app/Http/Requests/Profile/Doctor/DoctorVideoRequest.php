<?php

namespace App\Http\Requests\Profile\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorVideoRequest extends FormRequest
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
            'video_id' => 'nullable|integer|exists:uploaded_file,id'
        ];
    }
}
