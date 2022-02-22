<?php

namespace App\Http\Requests\Profile\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorCertificatRequest extends FormRequest
{
    public function rules()
    {
        return [
            'sertificat_id' => 'nullable|integer|exists:uploaded_file,id'
        ];
    }
}
