<?php

namespace App\Http\Requests\Profile\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorTimetablePlanRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'specialization_array' => 'required|array',
            'specialization_array.*' => 'required|integer|exists:lib_specialization,id',
        ];
    }
}
