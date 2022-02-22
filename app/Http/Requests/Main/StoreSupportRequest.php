<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupportRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'note' => 'required|string',
            'file_id' => 'nullable|integer|exists:uploaded_file,id',
        ];
    }
}
