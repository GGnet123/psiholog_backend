<?php

namespace App\Http\Requests\Favorite;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{

    public function rules()
    {
        return [
            'favor_type' => 'required|string|max:255',
            'el_id' => 'required|integer'
        ];
    }
}
