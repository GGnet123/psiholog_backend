<?php

namespace App\Http\Requests\Services\Uploader;

use Illuminate\Foundation\Http\FormRequest;

class MusicRequest extends FormRequest
{

    public function rules()
    {
        return [
            'upload_file' => 'required|file|mimes:mp3|max:30000',
            'title' => 'nullable|string'
        ];
    }
}
