<?php

namespace App\Http\Requests\Record;

use Illuminate\Foundation\Http\FormRequest;

class CreateRecordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'record_date' => 'required|date',
            'record_time' => 'required|integer|between:0,23'
        ];
    }
}
