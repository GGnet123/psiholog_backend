<?php

namespace App\Http\Requests\Services\Uploader;

use Illuminate\Foundation\Http\FormRequest;

class DropBoxRequest extends FormRequest
{

    public function rules()
    {
        return [
            'link' => 'required|string|max:255',
            'title' => 'nullable|string'
        ];
    }
}
