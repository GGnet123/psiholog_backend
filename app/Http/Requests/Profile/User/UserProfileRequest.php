<?php

namespace App\Http\Requests\Profile\User;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'avatar_id' => 'nullable|integer|exists:uploaded_file,id'
        ];
    }
}
