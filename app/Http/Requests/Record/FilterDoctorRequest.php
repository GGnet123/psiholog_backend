<?php

namespace App\Http\Requests\Record;

use Illuminate\Foundation\Http\FormRequest;

class FilterDoctorRequest extends FormRequest
{
    public function rules()
    {
        return [
            'customer_id' => 'nullable|integer|exists:users,id',
            'record_date' => 'nullable|date',
            'status_id' => 'nullable|date'
        ];
    }
}
