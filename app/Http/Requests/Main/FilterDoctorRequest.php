<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class FilterDoctorRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|integer',
            'price_b' => 'nullable|integer',
            'price_e' => 'nullable|integer',
            'specialization_array' => 'nullable|array',
            'specialization_array.*' => 'required|integer|exists:lib_specialization,id',
        ];
    }
}
