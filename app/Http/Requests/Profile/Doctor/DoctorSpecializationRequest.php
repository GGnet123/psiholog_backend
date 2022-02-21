<?php

namespace App\Http\Requests\Profile\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSpecializationRequest extends FormRequest
{
    protected function prepareForValidation(){
        if ($this->specialization_array && is_string($this->specialization_array)){
            $this->merge([
                'specialization_array' => explode(',', $this->specialization_array),
            ]);
        }
    }

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
