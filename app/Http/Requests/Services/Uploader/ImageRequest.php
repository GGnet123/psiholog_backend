<?php

namespace App\Http\Requests\Services\Uploader;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{


    public function rules()
    {
        return [
            'upload_file' => 'required|file|mimes:jpeg,bmp,png,gif,svg,pdf|max:8000',
            'title' => 'nullable|string'
        ];
    }
}
