<?php

namespace App\Http\Requests\Record;

use Illuminate\Foundation\Http\FormRequest;

class FilterCustromerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'doctor_id' => 'nullable|integer|exists:users,id',
            'record_date' => 'nullable|date',
            'status_id' => 'nullable|date'
        ];
    }
}
