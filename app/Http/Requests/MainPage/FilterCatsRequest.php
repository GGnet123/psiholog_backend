<?php

namespace App\Http\Requests\MainPage;

use Illuminate\Foundation\Http\FormRequest;

class FilterCatsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string'
        ];
    }
}
