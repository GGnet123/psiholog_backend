<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class FilterVideoGalaryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cat_id' => 'nullable|integer|exists:music_galary_cat,id',
        ];
    }
}
