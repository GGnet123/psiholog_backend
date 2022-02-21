<?php

namespace App\Http\Requests\Services\Uploader;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'upload_file' => 'required|file|mimes:mp4|max:8000',
            'title' => 'nullable|string'
        ];
    }
}
