<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class FaqVoteRequest extends FormRequest
{
    protected function prepareForValidation(){
        if ($this->vote && is_string($this->vote) && $this->vote == 'true'){
            $this->merge([
                'vote' => true,
            ]);
        }

        if ($this->vote && is_string($this->vote) && $this->vote == 'false'){
            $this->merge([
                'vote' => false,
            ]);
        }
    }

    public function rules()
    {
        return [
            'vote' => 'required|boolean',
        ];
    }
}
