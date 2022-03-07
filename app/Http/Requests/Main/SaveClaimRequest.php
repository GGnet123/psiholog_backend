<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class SaveClaimRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'note' => 'required|string',
            'file_id' => 'nullable|integer|exists:uploaded_file,id',
        ];
    }
}
