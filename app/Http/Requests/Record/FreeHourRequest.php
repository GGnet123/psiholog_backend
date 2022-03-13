<?php

namespace App\Http\Requests\Record;

use Illuminate\Foundation\Http\FormRequest;

class FreeHourRequest extends FormRequest
{
    public function rules()
    {
        return [
            'record_date' => 'required|date'
        ];
    }
}
